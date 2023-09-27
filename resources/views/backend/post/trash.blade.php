@extends('layouts.admin')
@section('title', $title??'Danh sách thương hiệu')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÙNG RÁC DANH MỤC</h1>
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
              <a href="{{ route('post.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
            </div>
          </div>
        </div>
        </div>
        <div class="card-body">
          @includeIf('backend.message')
          <table class="table table-bordered table-striped">
            <tr class="bg-primary">
              <th class="text-center" style="width: 5%">
                  <div class="form-group select-all">
                      <input type="checkbox">
                  </div>
              </th>
              <th class="text-center" style="width:10%">HÌNH</th>
              <th class="text-center" style="width:20%">TIÊU ĐỀ BÀI VIẾT</th>
              <th class="text-center" style="width:10%">SLUG</th>
              <th class="text-center" style="width:15%">NGÀY TẠO</th>
              <th class="text-center" style="width:20%">CHỨC NĂNG</th>
              <th class="text-center" style="width:5%">ID</th>
          </tr>
            @foreach ($list as $row)
                <tr>
                  <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                  <td>
                    <img src="{{ asset('images/post/'.$row->image) }}" class="img-fluid" alt="{{ $row->image }}">
                  </td>
                  <td>{{ $row->title }}</td>
                  <td>{{ $row->slug }}</td>
                  <td>{{ $row->created_at }}</td>
                  <td>
               <a href="{{ route('post.restore', ['post' => $row->id]) }}"
                                    class="btn btn-sm btn-info"> <i class="fas fa-undo"></i></i></a>
                    <a href="{{ route('post.edit',['post' => $row ->id]) }}" class="btn btn-sm btn-info" > <i class="fas fa-wrench"></i></a>
                    <a href="{{ route('post.show',['post' => $row ->id]) }}" class="btn btn-sm btn-danger "><i class="far fa-eye"></i></a>
                    <form action="{{ route('post.destroy',['post' => $row ->id]) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  </td>
                  <td>{{ $row->id }}</td>
                </tr>
            @endforeach
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