<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset ('dist/img/hung.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>  
      <div class="info">
        <a href="#" class="d-block">TRẦN THỊ THANH THỦY</a>
      </div>
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              SẢN PHẨM
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('product.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> TẤT CẢ SẢN PHẨM</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category.index') }} " class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> DANH MỤC SẢN PHẨM</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('brand.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> THƯƠNG HIỆU </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="nav-icon fas fa-comment"></i>
            <p>
              BÀI VIẾT
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('post.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> TẤT CẢ BÀI VIẾT</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('topic.index') }} " class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> CHỦ ĐỀ BÀI VIẾT </p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              GIAO DIỆN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('menu.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> MENU </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('slider.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> SLIDER </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
            <p>
              QUẢN LÝ KHÁCH HÀNG
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('order.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> ĐƠN HÀNG </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('contact.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> LIÊN HỆ </p>
              </a>
            </li>
          </ul>
        </li>
            <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              HỆ THỐNG
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> THÀNH VIÊN </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?option=user&cat=create" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> THÊM THÀNH VIÊN </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">LABELS</li>
        <li class="nav-item">
          <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">ĐĂNG XUẤT</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Warning</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Informational</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>