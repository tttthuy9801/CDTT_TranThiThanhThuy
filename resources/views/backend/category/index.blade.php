@extends('layouts.admin')
@section('title', $title ?? 'Danh sách danh mục')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DANH SÁCH DANH MỤC</h1>
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
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-6">
                            <button class="submit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">Thêm</a>
                            <a href="{{ route('category.trash') }}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash"></i>Thùng Rác</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @includeIf('backend.message')
                <table class="table table-bordered table-striped " id="dataTable">
                    <thead>
                        <tr class=" bg-primary">
                            <th class="text-center" style="width:20px;">#</th>
                             <th class="text-center"  style="width:50px;">HÌNH</th>
                            <th class="text-center">TÊN DANH MỤC</th>
                            <th class="text-center">SLUG</th>
                            <th class="text-center" style="width:160px;">NGÀY TẠO</th>
                            <th class="text-center" style="width:200px;">CHỨC NĂNG</th>
                            <th class="text-center" style="width:20px;">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                            <tr>
                                <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                                <td>
                                    <img src="{{ asset('images/category/' . $row->image) }}" class="img-fluid"
                                        alt="{{ $row->image }}">
                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->slug }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>
                                    @if ($row->status==1)
                                    
                                        <a href="{{ route('category.status', ['category' => $row->id]) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="fas fa-toggle-on"></i></a>
                                    @else
                                        <a href="{{ route('category.status', ['category' => $row->id]) }}"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-toggle-off"></i></a>
                                    @endif
                                    <a href="{{ route('category.edit', ['category' => $row->id]) }}"
                                        class="btn btn-sm btn-primary"> <i class="fas fa-edit"></i></i></a>
                                    <a href="{{ route('category.show', ['category' => $row->id]) }}"
                                        class="btn btn-sm btn-info "><i class="far fa-eye"></i></a>
                                    <a href="{{ route('category.delete', ['category' => $row->id]) }}"
                                        class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                                </td>
                                <td>{{ $row->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
@endsection
