<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/layout.css">
    
</head>
<body>

    <!--nld-header-->
    <section class="nld-maicontent">
        <div class="container">
            <div class="row logo">
                <div class="col-3">
                  <img src="{{ asset('images/logo.jpg')}}" alt="hinhLOGO">
                </div>
                <div class=" col-7 input-group mb-3 timkiem">
                  <input type="text" class="form-control" placeholder="Ban muốn tìm kiếm?" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
                <div class="col text-center hotline-1">    
                  <i class="fa-solid fa-phone hotline"></i>
                  <h6>HOTLINE</h6>
                  <h6>19001009</h6>                                                                     
                </div>
                <div class="col-1 giohang">
                  <i class="fa fa-shopping-basket hotline" aria-hidden="true"></i>
                  <h6>GIỎ HÀNG</h6>
                </div>
            </div>
        </div>
    </section>
    <div class="col-12 text-center">
                    <ul class="list-group ">
                  
                </div>
     <!--nld-maicontent-->
    <section class="nld-menu">
        <div class="container">
            <div class="row">
              <x-main-menu/>
            </div>
        </div>
    </section>
     <!--nld-menu-->
 <section class="maincontent">
            <div class="container my-3">
                <div class="row">
                    <div class="col-md-6 ">
                        <img class="img-fluid" src="{{ asset('images/product/' . $product->image) }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <h1>{{ $product->name }}</h1>
                        <h3>Giá gốc : <del>{{ $product->price }} </del></h3> <br>
                        <h1 class="text-danger"> Chỉ còn {{ $product->pricesale }}</h1>
                        <p>{{ $product->metadesc }}</p>
                        <input type="number" name="qty" id="qty" value="1" min="1">
                        <button class="btn btn-success"onclick="addcart({{ $product->id }})">Thêm Vào Giỏ
                            Hàng</button>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-12 my-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Chi tiết sản phẩm</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="danhgiabinhluan" data-bs-toggle="tab" data-bs-target="danhgiabinhluan"
                                type="button" role="tab" aria-controls="danhgiabinhluan" aria-selected="false">Bình
                                luận và đánh giá</button>
                        </li>
                    </ul>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{{!! $product->detail !!}}
                    </div>
                    <div class="tab-pane fade" id="danhgiabinhluan" role="tabpanel" aria-labelledby="danhgiabinhluan"><div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="5"></div>
                    </div>
                </div>
             </div></div>
        </section>
    </div>
     <!--nld-content-->
    <section class="nld-footer "><div class="banhcam">
        <div class="container maunen">
            <div class="row ">
                <div class="col-2 banhcam">
                    <img src="{{ asset('images/logo.jpg')}}" alt="canhcam">
                </div>
                <div class="col-7 loigoi ">
                    <h5>Đăng Kí Nhận Bảng Tin Từ JUTI FRUITS</h5>
                    <P>Đừng bỏ lỡ ưu đãi độc quyền dành riềng cho bạn</P>
                    <div class="col-auto">
                      <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                      <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Email của bạn là gì?">
                      </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="container text-center">
                      <div class="row icon">
                          <img src="{{ asset('images/download.png')}}" alt="">
                          <img src="images/facabook.png" alt="">
                          <img src="images/instagram.jpg" alt="">
                          <img src="images/twitter.png" alt="">
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container khuyencao">
            <div class="row">
                <div class="col-4">
                    <h5>HỖ TRỢ KHÁCH HÀNG</h5>
                    <ul>
                        <li>Sản Phẩm Và Đơn Hàng:0933 109 009</li>
                        <li>Kỹ Thuật Và Bảo Hành:0989 439 986</li>
                        <li>Điện thoại: (028) 3820 7153 (giờ hành chính)</li>
                        <li>Địa chỉ: 21A Nguyễn Thị Kiểu, P.Tân Thới Hiệp, Quận 12, Hồ Chí Minh</li>
                        <li>Sơ đồ đường đi</li>
                    </ul>
                </div>
                <div class="col-3">
                    <h5>TRỢ GIÚP</h5>
                    <ul>
                        <li>Đăng Kí Nhận Đặt Hàng</li>
                        <li>Hướng Dẫn Mua Hàng</li>
                        <li>Phương Thức Thanh Toán </li>
                        <li>Phương Thức Vận Chuyển</li>
                        <li>Chính Sách Đối Trả</li>
                        <li>Chính Sách Bồi Hoàn</li>
                        <li>Câu Hỏi Thường Gặp</li>
                    </ul>
                </div>
                <div class="col-2">
                    <h5>TÀI KHOẢN</h5>
                    <ul>
                        <li>Cập Nhật Tài Khoản</li>
                        <li>Giỏ Hàng</li>
                        <li>Lịch Sử Giao Dịch</li>
                        <li>Sản Phẩm Yêu Thích</li>
                        <li>Kiểm Tra Đơn Hàng</li>
                    </ul></div>
                <div class="col-3">
                    <h5>FRUITS AND VEGETABLES</h5>
                    <ul>
                        <li>Giới Thiệu</li>
                        <li>Đặt Hàng Trên FaceBook</li>
                        <li>Liên hệ Shop Tư Vấn </li>
                        <li>Gói Hàng Theo Yêu Cầu</li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </section>
     <!--nld-fotter-->
    <section class="nld-copyright">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <h5>TẢI ỨNG DỤNG TRÊN ĐIỆN THOẠI</h5>
                    <img src="images/icon-appstore.png" alt="">
                    <img src="images/icon-googleplay.png" alt="">
                </div>
                <div class="col-3">
                    <img src="images/logo_so_cong_thuong.png" alt="">
                    <h6>WEBSTTE CÙNG HỆ THỐNG</h6>
                    <img src="images/logo_hotdeal_2x.png" alt="">
                    <img src="images/logo_yesgo_2x.png" alt="">
                </div>
                <div class="col text-start">
                    <h6>CÔNG TY CỔ PHẦN XUẤT NHẬP KHẨU JUTI FRUITS </h6>
                    <p>Địa chỉ: 21A Nguyễn Thị Kiểu, P.Tân Thới Hiệp, Quận 12, Hồ Chí Minh</p>
                    <p>MST: 0303615027 do Sở Kế Hoạch Và Đầu Tư Tp.HCM cấp ngày 10/03/2011</p>
                    Tel: 028.73008182 - Fax: 028.39733234 - Email: jutifruits@gmail.com
                </div>
            </div>
        </div>
    </section>
     <!--nld-copyright-->
    <script src="js/bootstrap.bundle.min.js"></script>   
</body>
</html>