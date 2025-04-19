<!DOCTYPE html>
<html>
   <head>
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

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
        

      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50%; padding: 30px">

                     <div class="img-box" style="padding: 20px;">
                        <img src="/product/{{$product->image}}" alt="">
                     </div>
                     <div class="detail-box">

                        <h5>
                           {{$product->title}}
                        </h5>

                        <!-- Product Rating -->
                     <div class="mb-3">
                    @php
                    $rating = $product->rating ?? 5; // default ke 0 kalau null
                    @endphp

                    <div>
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= $rating)
                        <i class="bi bi-star-fill text-warning"></i>
                    @else
                        <i class="bi bi-star text-warning"></i>
                   @endif
                   @endfor
                   </div>
                       <small class="text-muted">Rating: {{$rating}}/5</small>
                   </div>


                   @if($product->discount_price)
                     <h6 style="color: red;">
                        Diskon harga<br>
                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                     </h6>
                     <h6 style="text-decoration: line-through; color: blue;">
                        Harga<br>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                     </h6>
                  @else
                     <h6 style="color: blue;">
                        Harga<br>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                     </h6>
                  @endif

                        <h6>Product Catagory : {{$product->catagory}}</h6>
                        <h6>Product Details : {{$product->description}}</h6>
                        <h6>Available Quantity : {{$product->quantity}}</h6>

                        <form action="{{url('add_cart',$product->id)}}" method="post">

                           @csrf

                           <div class="row">

                              <div class="col-md-4">

                              <input type="number" name="quantity" value="1" min="1" style="width: 100px;">

                              </div>

                              <div class="col-md-4">

                              <input type="submit" value="Add To Cart">

                              </div>

                           </div>

                           </form>

                     </div>
                  </div>
               </div>
      
    
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2025 All Rights Reserved By Bagus Dianto<a href="https://html.design/"> Famms-Bara Jati Furniture</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">Bagus Dianto</a>
         
         </p>
      </div>
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