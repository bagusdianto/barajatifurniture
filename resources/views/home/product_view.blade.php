<section class="product_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <!-- Form Pencarian Produk -->
         <div>
            <form action="{{ url('search_product') }}" method="GET">
               @csrf
               <input style="width: 350px;" type="text" name="search" placeholder="Search for something">
               <input type="submit" value="Search">
            </form>
         </div>
      </div>

      <!-- Alert Pesan -->
      @if(session()->has('message'))
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
         </div>
      @endif

      <!-- Daftar Produk -->
      <div class="row">
         @foreach($product as $products)
         <div class="col-sm-6 col-md-4 col-lg-4">
            <div class="box">
               <div class="option_container">
                  <div class="options">
                     <a href="{{ url('product_details', $products->id) }}" class="option1">
                        Product Details
                     </a>
                     <form action="{{ url('add_cart', $products->id) }}" method="post">
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

               <div class="img-box">
                  <img src="product/{{ $products->image }}" alt="{{ $products->title }}">
               </div>

               <div class="detail-box">
                  <h5>{{ $products->title }}</h5>

                  @if($products->discount_price)
                     <h6 style="color: red;">
                        Diskon Harga<br>
                        Rp {{ number_format($products->discount_price, 0, ',', '.') }}
                     </h6>
                     <h6 style="text-decoration: line-through; color: blue;">
                        Harga<br>
                        Rp {{ number_format($products->price, 0, ',', '.') }}
                     </h6>
                  @else
                     <h6 style="color: blue;">
                        Harga<br>
                        Rp {{ number_format($products->price, 0, ',', '.') }}
                     </h6>
                  @endif
               </div>
            </div>
         </div>
         @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-4 d-flex justify-content-center">
         {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
      </div>
   </div>
</section>
