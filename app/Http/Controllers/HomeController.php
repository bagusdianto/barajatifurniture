<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Stripe;

use App\Models\Comment;


use App\Models\Reply;

use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{


    public function index()
    {
        $product=Product::paginate(6);
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }




    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();

            $order=order::all();

            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;

            }

        $total_delivered=order::where('delivery_status','=','delivered')->get()->count();

        $total_processing=order::where('delivery_status','=','processing')->get()->count();
            



            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }

        else
        {
            $product=Product::paginate(10);

            $comment=comment::orderby('id','desc')->get();

            $reply=reply::all();

            return view('home.userpage',compact('product','comment','reply'));
        }
    }

    public function product_details($id)
    {
        $product=product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;
            $product = Product::find($id);
    
            $product_exist = Cart::where('Product_id', $id)
                                ->where('user_id', $userid)
                                ->first();
    
            if ($product_exist) {
                $cart = $product_exist;
                $cart->quantity += $request->quantity;
    
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }
    
                $cart->save();
    
                 Alert::warning('Barang sudah masuk ke keranjang. Kami telah menyesuaikan jumlahnya.');
                return redirect()->back();

            } else {
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
    
                $cart->Product_title = $product->title;
    
                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }
    
                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantity = $request->quantity;
    
                $cart->save();

                 Alert::warning('Barang sudah masuk ke keranjang. Kami telah menyesuaikan jumlahnya.');
    
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }
    
    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
            return view('home.showcart',compact('cart'));
        }
        
        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user=Auth::user();
        $userid=$user->id;
        
        $data=cart::where('user_id','=',$userid)->get();

        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->Product_id;

            $order->payment_status='paid';
            $order->delivery_status='processing';
            $order->save();
            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('Pesanan Anda telah kami terima. Kami akan segera menghubungi Anda untuk proses selanjutnya.');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank for payment." 
        ]);
        
        Session::flash('success', 'Payment successful!');
        return back();

    }

    public function show_order()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order=order::find($id);
        $order->delivery_status='Pesanan Anda telah dibatalkan';
        $order->save();
        return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment=new comment;

            $comment->name=Auth::user()->name;

            $comment->user_id=Auth::user()->id;

            $comment->comment=$request->comment;


            $comment->save();

            return redirect()->back();

        }

        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if(Auth::id())
        {
            $reply=new reply;

            $reply->name=Auth::user()->name;

            $reply->user_id=Auth::user()->id;

            $reply->comment_id=$request->commentId;

            $reply->reply=$request->reply;

            $reply->save();

            return redirect()->back();

        }

        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        $search_text=$request->search;
        $product=product::where('title','LIKE',"%$search_text%")->orWhere('catagory','LIKE',"$search_text")->paginate(10);
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function product()
    {
        $product=Product::paginate(10);
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        return view('home.all_product',compact('product','comment','reply'));
    }

    public function search_product(Request $request)
    {
        $comment=comment::orderby('id','desc')->get();
        $reply=reply::all();
        $search_text=$request->search;
        $product=product::where('title','LIKE',"%$search_text%")->orWhere('catagory','LIKE',"$search_text")->paginate(10);
        return view('home.all_product',compact('product','comment','reply'));
    }
    
    

    




}
