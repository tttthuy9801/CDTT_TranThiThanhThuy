@extends('layouts.admin')
@section('title', $title ?? 'Trang Quản Lý')
@section('content')
    <section class="content">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6 text-success">
                            <h1 style="text-transform: uppercase;  ">{{ $title }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('menu.index') }}"
                                        style="text-transform: capitalize;">Tất cả Danh Mục</a></li>
                                <li class="breadcrumb-item active ">{{ $title }}</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

            </section>
            <!-- Main content -->
            <section class="content">
                <form action="{{ route('menu.update', ['menu' => $menu->id]) }}" name="form1" method="post"
                    enctype="multipart/form-data">
                    @method('PUT')
                    <!-- Default box --> @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-save"></i> Lưu[Sửa]
                                    </button>
                                    <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                        <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @includeIf('backend.message_alert')

                            <div class="row">
                                <div class="col-md-12">
                                    @if ($menu->type != 'custom')
                                        <div>
                                            <label for="name">Tên Menu</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Việt Nam" readonly value="{{ old('name', $menu->name) }}">
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <label for="link">Liên Kết</label>
                                            <input type="text" name="link" id="link" class="form-control"
                                                placeholder="#" readonly value="{{ old('link', $menu->link) }}">
                                            @if ($errors->has('link'))
                                                <div class="text-danger">
                                                    {{ $errors->first('link') }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div>
                                            <label for="name">Tên Menu</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ old('name', $menu->name) }}">
                                            @if ($errors->has('name'))
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <label for="link">Liên Kết</label>
                                            <input type="text" name="link" id="link" class="form-control"
                                                value="{{ old('link', $menu->link) }}">
                                            @if ($errors->has('link'))
                                                <div class="text-danger">
                                                    {{ $errors->first('link') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <div>
                                        <label for="position">Vị trí đặt</label>
                                        <select name="position" id="position" class="form-control bg-gray">
                                            <option value="mainmenu"
                                                {{ old('status', $menu->position) == 'mainmenu' ? 'selected' : '' }}>Main
                                                Menu</option>
                                            <option value="footermenu"
                                                {{ old('status', $menu->position) == 'footermenu' ? 'selected' : '' }}>
                                                Footer Menu</option>

                                        </select>


                                    </div>
                                    <div>
                                        <label for="sort_order">Sắp xếp</label>
                                        <select name="sort_order" id="sort_order" class="form-control bg-gray">
                                            <option value="0">--Chọn vị trí--</option>
                                            {!! $html_sort_order !!}
                                        </select>


                                    </div>
                                    <div>
                                        <label for="parent_id">Cấp cha</label>
                                        <select name="parent_id" id="parent_id" class="form-control bg-gray">
                                            <option value="0">--Chọn chủ đề--</option>
                                            {!! $html_parent_id !!}
                                        </select>


                                    </div>
                                    <div class="">
                                        <label for="status">Trạng thái</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1"
                                                {{ old('status', $menu->status) == 1 ? 'selected' : '' }}>Xuất bản
                                            </option>
                                            <option value="2"
                                                {{ old('status', $menu->status) == 2 ? 'selected' : '' }}>Chưa xuất bản
                                            </option>

                                        </select>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-save"></i>Lưu[Sửa]
                                        </button>
                                        <a class="btn btn-sm btn-info" href="{{ route('menu.index') }}">
                                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                                        </a>
                                    </div>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                        </div>
                        <!-- /.card -->
                </form>
            </section>
            <!-- /.content -->
        </div>
    </section>

@endsection
