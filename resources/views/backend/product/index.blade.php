@extends('layouts.admin ')

@section('title', $title)
@section('content')

<div class="content-wrapper">
  <form name="form1" method="post" enctype="multipart/form-data">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DANH SÁCH SẢN PHẨM</h1>
            
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
              <button class="submit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </div>
            <div class="col text-right">
              <a href="{{ route('product.create') }}" class="btn btn-sm btn-success">Thêm</a>
              <a href="{{ route('product.trash') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Thùng Rác</a>
            </div>
          </div>
        </div>
        
        <div class="card-body">
          @includeIf('backend.message')
          <table class="table table-bordered" id="dataTable">
            <thead>
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
          </tr></thead>
          <tbody>
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
                    @if($row->status==1)
                    <a href="{{ route('product.status',['product' => $row ->id]) }}" class="btn btn-sm btn-success">
                    <i class="fas fa-toggle-on"></i></a>
                      @else
                      <a href="{{ route('product.status',['product' => $row ->id]) }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-toggle-off"></i></a>
                      @endif
                    <a href="{{ route('product.edit',['product' => $row ->id]) }}" class="btn btn-sm btn-info" > <i class="fas fa-wrench"></i></a>
                    <a href="{{ route('product.show',['product' => $row ->id]) }}" class="btn btn-sm btn-primary "><i class="far fa-eye"></i></a>
                    <a href="{{ route('product.delete',['product' => $row ->id]) }}" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></a>
                  </td>
                  <td>{{ $row->id }}</td>
                </tr>
            @endforeach</tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-header">
          
          <div class="row">
            <div class="col-6">
              <button class="submit btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </div>
            <div class="col text-right">
              <a href="{{ route('product.create') }}" class="btn btn-sm btn-success">Thêm</a>
              <a href="{{ route('product.trash') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Thùng Rác</a>
            </div>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      
    </section>
  </form>
    <!-- /.content -->
  </div>
@endsection