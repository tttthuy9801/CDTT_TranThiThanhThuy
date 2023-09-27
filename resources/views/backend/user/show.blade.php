@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')
    @endphp
    @endphp
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CHI TIẾT THÀNH VIÊN</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->

                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('user.edit',['user'=>$row->id]) }}" class="btn btn-sm btn-success"><i
                                    class="fas fa-edit"></i>Sửa</a>

                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-undo-alt"></i>Quay về danh sách</a>
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered border-primary table-hover ">
                        <thead class="bg-primary">
                            <tr class="fs-1">
                                <th width="30%">
                                    TÊN TRƯỜNG
                                </th>
                                <th>
                                    GIÁ TRỊ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $row->id }}</td>
                            </tr>
                            <tr>
                                <th>HỌ VÀ TÊN</th>
                                <td>{{ $row->name }}</td>
                            </tr>
                            <tr>
                                <th>TÊN ĐĂNG NHẬP</th>
                                <td>{{ $row->userrname }}</td>
                            </tr>
                            <tr>
                                <th>MẬT KHẨU</th>
                                <td>{{ $row->password }}</td>
                            </tr>
                            <tr>
                                <th>EMAIL</th>
                                <td>{{ $row->email }}</td>
                            </tr>
                            <tr>
                                <th>GIỚI TÍNH</th>
                                <td>{{ $row->gender }}</td>
                            </tr>
                            <tr>
                                <th>ĐIỆN THOẠI</th>
                                <td>{{ $row->phone }}</td>
                            </tr>
                            <tr>
                                <th>HÌNH ẢNH</th>
                                <td class="index-img">
                                    <img src="{{ asset('images/user/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                            </tr>
                            <tr>
                                <th>QUYỀN TRUY CẬP</th>
                                <td>{{ $row->roles }}</td>
                            </tr>
                            <tr>
                                <th>ADDRESS</th>
                                <td>{{ $row->address }}</td>
                            </tr>
                            <tr>
                                <th>NGÀY TẠO</th>
                                <td>{{ $row->created_at }}</td>
                            </tr>
                            <tr>
                                <th>NGƯỜI TẠO</th>
                                <td>{{ $row->created_by }}</td>
                            </tr>
                            <tr>
                                <th>NGÀY SỬA CUỐI</th>
                                <td>{{ $row->updated_at }}</td>
                            </tr>
                            <tr>
                                <th>NGƯỜI SỬA CUỐI</th>
                                <td>{{ $row->updated_by }}</td>
                            </tr>
                            <tr>
                                <th>TRẠNG THÁI</th>
                                <td>{{ $row->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
        </div>
    </form>
@endsection