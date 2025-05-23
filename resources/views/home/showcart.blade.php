<!DOCTYPE html>
<html>
   <head>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Bara Jati Furniture</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

      <style type="text/css">

     .center 
     {
    margin: auto;
    width: 95%;
    max-width: 1000px;
    text-align: center;
    padding: 30px;
    overflow-x: auto;
    }


        table,th,td
        {
            border: 1px solid grey;
        }

        .th_deg
        {
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }

        .img_deg
        {
         height: 200px;
         width: 200px;
        }

        .total_deg
        {
         font-size: 20px;
         padding: 40px;
        }
    

      </style>
   </head>
   <body>

   @include('sweetalert::alert')

   
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         
         <!-- end slider section -->

         @if(session()->has('message'))

             <div class="alert alert-success">

             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
             {{session()->get('message')}}

             </div>

         @endif
     
         <div class="center table-responsive">
  <table class="table table-bordered">

            <tr>

            <th class="th_deg">Product title</th>
            <th class="th_deg">Product quantity</th>
            <th class="th_deg">price</th>
            <th class="th_deg">Image</th>
            <th class="th_deg">Action</th>

            </tr>

            <?php $totalprice=0;  ?>

            @foreach($cart as $cart)

            <tr>

            <td>{{$cart->product_title}}</td>
            <td>{{$cart->quantity}}</td>
            <td>Rp {{ number_format($cart->price, 0, ',', '.') }}</td>

            <td><img class="img_deg" src="/product/{{$cart->image}}"></td>
            <td>
               <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('/remove_cart',$cart->id)}}">Remove Product</a>
            </td>

            </tr>

            <?php $totalprice=$totalprice + $cart->price ?>

            @endforeach

        </table>

        <div>

        <h1 class="total_deg">Total Price : Rp {{ number_format($totalprice, 0, ',', '.') }}</h1>


        </div>

        <div>

         <h1 style="font-size: 25px; padding-bottom: 15px;">Melanjutkan Membeli</h1>

         <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>

         <!-- <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pembayaran</a> -->

        </div>


      </div>
     
      <!-- footer start -->
      
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2025 All Rights Reserved By Bagus Dianto<a href="https://html.design/"> Famms-Bara Jati Furniture</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">Bagus Dianto</a>
         
         </p>
      </div>

      <script>
         function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
               title: "Apakah kamu yakin ingin membatalkan produk ini?",
               text: "Kamu tidak akan bisa membatalkannya!!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
            })
            .then((willCancel) => {

               if (willCancel) {

                  window.location.href = urlToRedirect;
               }
            });
         }

      </script>

      


      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="homejs/custom.js"></script>
   </body>
</html>