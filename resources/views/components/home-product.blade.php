<div class="container cachnhau"><hr>
            <h3 class="mauh3">{{ $cat->name }}</h3>
            <h6 class="text-end xemthem">Xem Thêm...></h6>
            <div class="row ab">
                
                @foreach ($list_product as $product)
                <div class="col-3">
                                       <div class="swiper-slide item radius">
                                           <div class="product-box">
                                               <a class="d-flex img-box"
                                                   href="{{$product->slug}}"><img
                                                       class="lazyload"
                                                       src="{{ asset('images/product/' . $product->image) }}" /></a>
                                               <div class="info-box pt-2">
                                                   <h4 class="product-name mb-0"><a class="d-block"
                                                           href="{{$product->slug }}">{{ $product->name }}</a>     
                                                   </h4>
                                               </div>
                                               <div class="price-green text-info">
                                                   {{ $product->price }}.000 VND
                                               </div>
                                               <div class="price-green">
                                                   <div class="price-left">
                                                       <p class="price">Liên hệ</p>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                        </div>
                                   @endforeach
                                  
</div>