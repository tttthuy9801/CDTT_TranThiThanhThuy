@extends('layouts.admin')

@section('title', $title)
@section('content')
@endphp
@endphp
<form action="{{ route('product.update', ['product' => $row->id]) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('PUT')  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SỬA SẢN PHẨM</h1>
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
            <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <div class="mb-3">
              <label for="name">Tên danh mục</label>
              <input type="text" name="name" id="name" value="{{  old('name',$row->name) }}" class="form-control">
              @if ($errors->has('name'))
                 <div class="text-danger">
                    {{ $errors->first('name') }}
                 </div>
               @endif
            </div>
            <div class="mb-3">
              <label for="metakey">Từ khóa</label>
        <textarea name="metakey" id="metakey" class="form-control">{{ old('metakey',$row->metakey) }}</textarea>
              @if ($errors->has('metakey'))
              <div class="text-danger">
                  {{ $errors->first('metakey') }}
              </div>
          @endif
          </div>
          <div class="mb-3">
            <label for="metadesc">Mô tả</label>
      <textarea name="metadesc" id="metadesc" class="form-control">{{ old('metadesc',$row->metadesc) }}</textarea>
            @if ($errors->has('metadesc'))
            <div class="text-danger">
                {{ $errors->first('metadesc') }}
            </div>
        @endif
        </div>
        <div class="mb-3">
          <label for="detail">Chi tiết</label>
    <textarea name="detail" id="detail" class="form-control">{{ old('detail',$row->detail) }}</textarea>
          @if ($errors->has('detail'))
          <div class="text-danger">
              {{ $errors->first('detail') }}
          </div>
      @endif
      </div>
            <div class="mb-3">
<label for="qty">Số lượng</label>
              <input type="number" name="qty" id="qty" value="{{  old('qty',$row->qty) }}" class="form-control">
              @if ($errors->has('qty'))
                 <div class="text-danger">
                    {{ $errors->first('qty') }}
                 </div>
               @endif
            </div>
            
        </div>
            <div class="col-md-3">
            <div class="mb-3">
              <label for="category_id">Danh mục sản phẩm</label>
              <select name="category_id" id="name" class="form-control">
              <option value="0">Cấp cha</option>
              {!! $html_category_id !!}
            </select>
            </div>
            <div class="mb-3">
              <label for="brand_id">Thương hiệu</label>
              <select name="brand_id" id="name" class="form-control">
              <option value="0">Cấp cha</option>
              {!! $html_brand_id!!}
            </select>
          </div>
          <div class="mb-3">
            <label for="image">Hình đại diện</label>
            <input name="image" id="name" type="file" class="form-control">
        </div>
        <div class="mb-3">
          <label for="price">Giá</label>
            <input type="number" name="price" id="price" value="{{  old('price',$row->price) }}" class="form-control">
            @if ($errors->has('price'))
               <div class="text-danger">
                  {{ $errors->first('price') }}
               </div>
             @endif
          </div>
          <div class="mb-3">
            <label for="pricesale">Giá Khuyến mãi</label>
              <input type="number" name="pricesale" id="pricesale" value="{{  old('pricesale',$row->pricesale) }}" class="form-control">
              @if ($errors->has('pricesale'))
                 <div class="text-danger">
                    {{ $errors->first('pricesale') }}
                 </div>
               @endif
            </div>
      </div>
      </div>
        <!-- /.card-body -->
        <div class="card-header">
          
          
          <div class="row">
            <div class="col-12 text-right">
              <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
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
</form>
@endsection