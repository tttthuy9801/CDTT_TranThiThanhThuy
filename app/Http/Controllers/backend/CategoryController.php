<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Danh sách danh mục';                                                                                                             #$title...
        $list = Category::where('status', '!=', '0')->orderBy('status', 'asc')->get();
        return view('backend.category.index', compact('list', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo';
        $list = Category::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value =''" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value ='' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
        }
        return view("backend.category.create", compact('html_parent_id', 'html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $row = new Category();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        $row->level = 0;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = Auth::id();
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/category'), $fileName);
                $row->image = $fileName;
                //$category ->image = $request->image;
            }
        }
        if ($row->save()) {
            $link = new Link();
            $link->slug = $row->slug;
            $link->table_id = $row->id;
            $link->type = 'category';
            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
        } else {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm không thành công']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $title = "Chi tiết mãu tin";
        return view('backend.category.show', compact('row', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Category::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            if ($item->id == $row->parent_id) {
                $html_parent_id .= "<option selected value ='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $html_parent_id .= "<option value ='" . $item->id . "'>" . $item->name . "</option>";
            }
            if ($item->sort_order == $row->sort_order) {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            } else {
                $html_sort_order .= "<option value =' " . ($item->sort_order + 1) . "'>" . $item->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.category.edit', compact('row', 'title', 'html_sort_order', 'html_parent_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');;
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        $row->level = 0;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id();
        $row->status = 2;

        $file = $request->file('image');
        if ($file != NULL) {
            var_dump('file');
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/category'), $fileName);
                $row->image = $fileName;
                //$category ->image = $request->image;
            }
        }


        if ($row->save()) {
            $link = Link::where([['type','=','category'],['table_id','=',$id]])->first();
            $link->slug = $row->slug;
            $link->save();
            return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công']);
        } else {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Thêm không thành công']);
        }    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Category::find($id);
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        if ($row->delete()) {
            $link = link::where([['table_id', '=', $id], ['type', '=', 'category']])->first();
            $link->slug = $row->slug;
            $link->delete();
        }
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm khỏi CSDL thành công']);
    }
    public function trash()
    {
        $list = Category::where('status', '=', '0')->orderBy('created_at', 'asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.category.trash', compact('list'));
    }


    public function status($id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái sản phẩm thành công']);
    }
    public function delete($id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 0;
        $row->save();
        return redirect()->route('category.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }


    public function restore($id)
    {
        $row = Category::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('category.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 2;
        $row->save();
        return redirect()->route('category.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục sản phẩm thành công']);
    }
}
