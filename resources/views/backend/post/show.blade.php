@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')
    @endphp
    @endphp
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CHI TIẾT BÀI VIẾT</h1>
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
                            <a href="{{ route('post.edit', ['post' => $row->id]) }}" class="btn btn-sm btn-success"><i
                                    class="fas fa-edit"></i>Sửa</a>

                            <a href="{{ route('post.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-undo-alt"></i>Quay về danh sách</a>
                            <a href="{{ route('post.index') }}" class="btn btn-sm btn-danger">
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
                                <th>TIÊU ĐỀ BÀI VIẾT</th>
                                <td>{{ $row->title }}</td>
                            </tr>
                            <tr>
                                <th>SLUG</th>
                                <td>{{ $row->slug }}</td>
                            </tr>
                            <tr>
                                <th>CHI TIẾT BÀI VIẾT</th>
                                <td>{{ $row->detail }}</td>
                            </tr>
                            <tr>
                                <th>HÌNH ẢNH</th>
                                <td class="index-img">
                                    <img src="{{ asset('images/post/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                            </tr>
                            <tr>
                                <th>KIỂU BÀI VIẾT</th>
                                <td>{{ $row->type }}</td>
                            </tr>
                            <tr>
                                <th>TỪ KHOÁ SEO</th>
                                <td>{{ $row->metakey }}</td>
                            </tr>
                            <tr>
                                <th>MÔ TẢ</th>
                                <td>{{ $row->metadesc }}</td>
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