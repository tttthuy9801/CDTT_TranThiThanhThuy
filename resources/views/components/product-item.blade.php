<section class="home-product pb-md-3 pb-3">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="row-title">
                       <div class="titlebox">
                           <h2 class="title">
                              <h3 class="text-white ">SẢN PHẨM CÙNG LOẠI</h3>
                           </h2>
                       </div>
                   </div>
               </div>
               <div class="col-12">
                   <div class="tab-content" id="myTabWhyContent">
                       <div class="tab-pane fade show active" id="product-content265_0" role="tabpanel"
                           aria-labelledby="product-content265_0">
                           <div class="swiper-product-home swiper-container">
                               <div class="swiper-wrapper list-products">
                                   @foreach ($list_product as $item)
                                       <div class="swiper-slide item radius">
                                           <div class="product-box">
                                               <a class="d-flex img-box"
                                                   href="http://localhost/nguyenleduc_2121110018_laravel/public/{{$item->slug}}"><img
                                                       class="lazyload"
                                                       src="{{ asset('images/product/' . $item->image) }}" /></a>
                                               <div class="info-box pt-2">
                                                   <h4 class="product-name mb-0"><a class="d-block"
                                                           href="http://localhost/nguyenleduc_2121110018_laravel/public/{{$item->slug }}">{{ $item->name }}</a>
                                                           
                                                   </h4>
                                               </div>
                                               <div class="price-green text-info">
                                                   {{ $item->pricesale }}.000 VND
                                               </div>
                                               <div class="price-green">
                                                   <div class="price-left">
                                                       <p class="price">Liên hệ</p>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>
