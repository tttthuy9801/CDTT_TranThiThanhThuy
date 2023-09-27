@extends('layouts.admin')

@section('title', $title)
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
                            <h1>THÊM BÀI VIẾT</h1>
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
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
                            <a href="{{ route('post.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về
                                danh sách</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="title">Tiêu đề bài viết</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="form-control">
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết bài viết</label>
                                <input type="text" name="detail" id="detail" value="{{ old('detail') }}"
                                    class="form-control">
                                @if ($errors->has('detail'))
                                    <div class="text-danger">
                                        {{ $errors->first('detail') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khoá</label>
                                <textarea type="text" name="metakey" id="metakey" class="form-control" value="{{ old('metakey') }}"
                                    class="form-control"></textarea>
                                @if ($errors->has('metakey'))
                                    <div class="text-danger">
                                        {{ $errors->first('metakey') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea type="text" name="metadesc" id="metadesc" value="{{ old('metadesc') }}" class="form-control"></textarea>
                                @if ($errors->has('metadesc'))
                                    <div class="text-danger">
                                        {{ $errors->first('metadesc') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="image">Hình đại diện</label>
                                <input name="image" id="name" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="type">Kiểu</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="0">Cấp cha</option>
                                    <option value="1">post</option>
                                    <option value="2">page</option>
                                </select>
                            </div>
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
