@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')
    @endphp
    @endphp
    <form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CHI TIẾT ĐƠN HÀNG</h1>
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
                            <a href="{{ route('order.edit', ['order' => $row->id]) }}" class="btn btn-sm btn-success"><i
                                    class="fas fa-edit"></i>Sửa</a>
                            <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-undo-alt"></i>Quay về danh sách</a>
                            <a href="{{ route('order.index') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered border-primary table-hover ">
                        <thead class="bg-success">
                            <tr class="fs-1">
                                <th width="30%">
                                    TÊN TRƯỜNG
                                </th>
                                <th>
                                    GÁI TRỊ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $row->id }}</td>
                            </tr>
                            <tr>
                                <th>CODE ĐƠN HÀNG</th>
                                <td>{{ $row->code }}</td>
                            </tr>
                            <tr>
                                <th>MÃ KHÁCH HÀNG</th>
                                <td>{{ $row->user_id }}</td>
                            </tr>
                             <tr>
                                <th>NGÀY XUẤT</th>
                                <td>{{ $row->exportdate}}</td>
                            </tr>
                            <tr>
                                <th>ĐỊA CHỈ NGƯỜI NHẬN</th>
                                <td>{{ $row->deliveryaddress }}</td>
                            </tr>
                            <tr>
                                <th>TÊN NGƯỜI NHẬN</th>
                                <td>{{ $row->deliveryname }}</td>
                            </tr>
                            <tr>
                                <th>ĐIỆN THOẠI NGƯỜI NHẬN</th>
                                <td>{{ $row->deliveryphone }}</td>
                            </tr>
                            
                            <tr>
                                <th>EMAIL NGƯỜI NHẬN</th>
                                <td>{{ $row->deliveryemail }}</td>
                            </tr>
                            <tr>
                                <th>NGÀY TẠO</th>
                                <td>{{ $row->created_at }}</td>
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