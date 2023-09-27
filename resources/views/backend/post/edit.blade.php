@extends('layouts.admin')

@section('title', $title ?? 'Trang quản lý')
@section('content')

    <form action="{{ route('post.update', ['post' => $row->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>CẬP NHẬT BÀI VIẾT</h1>
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

                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>



                            <a href="{{ route('post.index') }}" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>Xóa</a>
                            <a class="btn btn-sm btn-info" href="{{ route('post.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> QUAY VỀ DANH SÁCH
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-9">
                        <div class="mb-3">
                          <label for="title">Tiêu đề bài viết</label>
                          <input type="text" name="title" id="title" value="{{  old('title', $row->title) }}" class="form-control">
                          @if ($errors->has('name'))
                             <div class="text-danger">
                                {{ $errors->first('name') }}
                             </div>
                           @endif
                        </div>
                        <div class="mb-3">
                          <label for="detail">Chi tiết bài viết</label>
                          <input type="text" name="detail" id="detail" value="{{  old('detail', $row->detail) }}" class="form-control">
                          @if ($errors->has('detail'))
                             <div class="text-danger">
                                {{ $errors->first('detail') }}
                             </div>
                           @endif
                        </div>
                        <div class="mb-3">
                          <label for="metakey">Từ khoá</label>
                          <textarea type="text" name="metakey" id="metakey" class="form-control" value="{{  old('metakey', $row->metakey) }}" class="form-control"></textarea>
                          @if ($errors ->has('metakey'))
                          <div class="text-danger">
                            {{ $errors->first('metakey') }}
                          </div>
                          @endif
                        </div>
                        <div class="mb-3">
                          <label for="metadesc">Mô tả</label>
                          <textarea type="text" name="metadesc" id="metadesc" value="{{  old('metadesc', $row->metadesc) }}" class="form-control"></textarea>
                          @if ($errors ->has('metadesc'))
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
                  </div>
                  </div>
        <!-- /.card-body -->
        <div class="card-header">
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>



                    <a href="{{ route('post.index') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>Xóa</a>
                    <a class="btn btn-sm btn-info" href="{{ route('post.index') }}">
                        <i class="fas fa-arrow-circle-left"></i> QUAY VỀ DANH SÁCH
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
    </form>
@endsection