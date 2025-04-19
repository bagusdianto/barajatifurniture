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

      
      <style type="text/css">

        .center
        {
            margin: auto;
            width: 40%;
            padding: 30px;
            text-align: center;
        }

        table,th,td
        {
            border: 1px solid black;
        }

        .th_deg 
        {
    padding: 10px;
    background-color: skyblue;
    font-size: 20px;
    font-weight: bold;
        }

        

      </style>


   </head>
   <body>
     
         <!-- header section strats -->
         @include('home.header')
         
         <div class="center table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Payment Status</th>
                <th class="th_deg">Delivery Status</th>
                <th class="th_deg">Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $order)
            <tr>
                <td>{{ $order->product_title }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->delivery_status }}</td>
                <td>
                    <img height="100" width="180" src="product/{{ $order->image }}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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