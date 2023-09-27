<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách thương hiệu';                                                                                                             #$title...
        $list = Brand::where('status', '<>', '0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.index', compact('list', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $title = 'Tạo';
        $list = Brand::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_sort_order .= "<coption value =''" . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.brand.create", compact('html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $row = new Brand();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->sort_order = $request->sort_order;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id();
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
            }
        }

        if ($row->save()) {
            $link = new Link();
            $link->slug = $row->slug;
            $link->table_id = $row->id;
            $link->type = 'brand';
            $link->save();
            return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
        } else {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm không thành công']);
        }
    }

    public function show($id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $title = "Chi tiết mãu tin";
        return view('backend.brand.show', compact('row', 'title'));
    }

    public function edit($id)
    {
        $row = brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = brand::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_sort_order = '';
        foreach ($list as $item) {
            if ($item->sort_order == $row->sort_order) {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            } else {
                $html_sort_order .= "<option value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.brand.edit', compact('row', 'title', 'html_sort_order'));
    }


    public function update(UpdateBrandRequest $request, $id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->sort_order = $request->sort_order;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id();
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
                //$brand ->image = $request->image;
            }
        }


        if ($row->save()) {
            $link = Link::where([['type', '=', 'brand'], ['table_id', '=', $id]])->first();
            $link->slug = $row->slug;
            $link->save();
            return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
        } else {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm không thành công']);
        }      }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Brand::find($id);
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        if ($row->delete()) {
            $link = link::where([['table_id', '=', $id], ['type', '=', 'brand']])->first();
            $link->slug = $row->slug;
            $link->delete();
        }
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm khỏi CSDL thành công']);
    }
    public function trash()
    {
        $list = Brand::where('status', '=', '0')->orderBy('created_at', 'asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.brand.trash', compact('list'));
    }
    public function status($id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái sản phẩm thành công']);
    }
    public function delete($id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 0;
        $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }


    public function restore($id)
    {
        $row = Brand::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('brand.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 2;
        $row->save();
        return redirect()->route('brand.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục sản phẩm thành công']);
    }
}
