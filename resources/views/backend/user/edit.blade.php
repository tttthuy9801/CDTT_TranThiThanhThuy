@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')

    <form action="{{ route('user.update', ['user' => $row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CẬP NHẬT THƯƠNG HIỆU</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->

                <div class="card">
                  <div class="card-header">
                      <div class="row">
                          <div class="col-12 text-right">
                              <button type="submit" class="btn btn-sm btn-success">
                                  <i class="fas fa-save"></i>Lưu
                              </button>
                              <a class="btn btn-sm btn-info" href="{{ route('user.index') }}">
                                  <i class="fas fa-arrow-circle-left"></i> QUAY VỀ DANH SÁCH
                              </a>
                          </div>
                      </div>
                  </div>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-6">
                                <div class="mb-3">
      
                                  <label for="username">Tên tài khoản</label>
                                  <input type="text" name="username" id="username" value="{{ old('username',$row->username) }}"
                                      class="form-control">
              
                                  @if ($errors->has('username'))
                                      <div class="text-danger">
                                          {{ $errors->first('username') }}
                                      </div>
                                  @endif
              
                              </div>
                              <div class="mb-3">
      
                                <label for="password">Mật khẩu</label>
                                <input type="text" name="password" id="password" value="{{ old('password',$row->password) }}"
class="form-control">
            
                                @if ($errors->has('password'))
                                    <div class="text-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
            
                            </div>
                            
                          <div class="mb-3">
                            <label for="email">Email</label>
      <input name="email" type="email" id="email" class="form-control" value="{{ old('email',$row->email) }}">
                            @if ($errors->has('email'))
                            <div class="text-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        </div>
                        <div class="mb-3">
                          <label for="phone">Số điện thoại</label>
                          <input name="phone" type="tel" id="phone" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" class="form-control" value="{{ old('phone',$row->phone) }}">
                          @if ($errors->has('phone'))
                          <div class="text-danger">
                              {{ $errors->first('phone') }}
                          </div>
                      @endif
                      </div>
      
                              </div>
                              <div class="col-md-6">
                                <div class="mb-3">
      
                                  <label for="name">Tên thành viên</label>
                                  <input type="text" name="name" id="name" value="{{ old('name',$row->name) }}"
                                      class="form-control">
      
                                  @if ($errors->has('name'))
                                      <div class="text-danger">
                                          {{ $errors->first('name') }}
                                      </div>
                                  @endif
      
                              </div>
                                  <div class="mb-3">
                                      <label for="gender">GIỚI TÍNH</label><br>
                                      <input type="radio" name="gender" id="gender" value="0" checked="checked"><label for="0">Male</label>
                                      <input type="radio" name="gender" id="gender" value="1" ><label for="1">Female</label>
                                  </div>
                                  <div class="mb-3">
      
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" name="address" id="address" value="{{ old('address',$row->address) }}"
                                        class="form-control">
        
                                    @if ($errors->has('address'))
<div class="text-danger">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
        
                                </div>
                                <div class="mb-3">
                                  <label for="image">Hình</label>
                                  <input name="image" id="image" type="file" class="form-control btn-sm">
                              </div>
                                  
                              </div>
                          </div>
                      </div>
                      
                  </div>

        <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
        </div>
    </form>
@endsection