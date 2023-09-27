@extends('layouts.admin')
@section('title', $title??'Danh sách thương hiệu')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÙNG RÁC SẢN PHẨM</h1>
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
            <div class="col-6">
             
            </div>
            <div class="col text-right">
              <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
            </div>
          </div>
        </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="myTable">
            <tr class="bg-primary">
              <th class="text-center" style="width: 5%">
                  <div class="form-group select-all">
                      <input type="checkbox">
                  </div>
              </th>
              <th class="text-center" style="width:10%">HÌNH</th>
              <th class="text-center" style="width:20%">TÊN SẢN PHẨM</th>
              <th class="text-center" style="width:10%">DANH MỤC</th>
              <th class="text-center" style="width:15%">THƯƠNG HIỆU</th>
              <th class="text-center" style="width:15%">NGÀY TẠO</th>
              <th class="text-center" style="width:20%">CHỨC NĂNG</th>
              <th class="text-center" style="width:5%">ID</th>
          </tr>
            @foreach ($list as $row)
                <tr>
                  <td><input type="checkbox" name="checkId[]" value="{{ $row->id }}"></td>
                  <td>
                    <img src="{{ asset('images/product/'.$row->image) }}" class="img-fluid" alt="{{ $row->image }}">
                  </td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->category_name }}</td>
                  <td>{{ $row->brand_name }}</td>
                  <td>{{ $row->created_at}}</td>
                  <td>
                    <a href="{{ route('product.restore',['product' => $row ->id]) }}" class="btn btn-sm btn-primary "><i class="fas fa-undo"></i></a>
                    <form action="{{ route('product.destroy',['product' => $row ->id]) }}" method="POST">
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
        <div class="card-header">
          
          <div class="row">
            <div class="col-6">
             
            </div>
            <div class="col text-right">
              <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
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