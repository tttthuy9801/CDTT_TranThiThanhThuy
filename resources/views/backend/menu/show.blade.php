@extends('layouts.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 style="text-transform: uppercase;  ">{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('menu.index') }}"
                                    style="text-transform: capitalize;">Tất cả thương hiệu</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('menu.edit', ['menu' => $menu->id]) }} ">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('menu.delete', ['menu' => $menu->id]) }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @includeIf('backend.message_alert')
                    <table class="table table-bordered border-primary table-hover ">
                        <thead class="bg-orange">
                            <tr class="fs-1">
                                <th width="30%">
                                    Tên trường
                                </th>
                                <th>
                                    Giá trị
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <td>{{ $menu->id }}</td>
                            </tr>
                            <tr>
                                <th>Tên Menu</th>
                                <td>{{ $menu->name }}</td>
                            </tr>
                            <tr>
                                <th>Liên kết</th>
                                <td>{{ $menu->link }}</td>
                            </tr>
                            <tr>
                                <th>Kiểu</th>
                                <td>{{ $menu->type }}</td>
                            </tr>
                            <tr>
                                <th>Table Id</th>
                                <td>{{ $menu->table_id }}</td>
                            </tr>
                            <tr>
                                <th>Vị trí</th>
                                <td>{{ $menu->position }}</td>
                            </tr>
                            <tr>
                                <th>Mức</th>
                                <td>{{ $menu->level }}</td>
                            </tr>
                            <tr>
                                <th>Mã cấp cha</th>
                                <td>{{ $menu->parent_id }}</td>
                            </tr>
                            <tr>
                                <th>Ngày tạo</th>
                                <td>{{ $menu->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Người tạo</th>
                                <td>{{ $menu->created_by }}</td>
                            </tr>
                            <tr>
                                <th>Ngày sửa cuối</th>
                                <td>{{ $menu->updated_at }}</td>
                            </tr>
                            <tr>
                                <th>Người sửa cuối</th>
                                <td>{{ $menu->updated_by }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>{{ $menu->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                            <a class="btn btn-sm btn-primary" href="{{ route('menu.edit', ['menu' => $menu->id]) }} ">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('menu.delete', ['menu' => $menu->id]) }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

@endsection
