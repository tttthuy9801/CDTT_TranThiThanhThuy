<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    protected $list_type;
    public function __construct()
    {
        $this->list_type = [
            'category' => 'Danh mục',
            'brand' => 'Thương hiệu',
            'topic' => 'Chủ đề',
            'page' => 'Trang đơn',
            'custom' => 'Tùy biến',

        ]; // Gán giá trị ban đầu cho thuộc tính
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_menu = Menu::where('status', '!=', '0')
            ->orderBy('position', 'asc')
            ->orderBy('sort_order', 'asc')
            ->get();
        $list_category = Category::where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
        $list_brand = Brand::where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
        $list_topic = Topic::where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->get();
        $list_page = Post::where([['status', '=', '1'], ['type', '=', 'page']])
            ->orderBy('created_at', 'desc')
            ->get();
        $list_type = [
            'category' => 'Danh mục',
            'brand' => 'Thương hiệu',
            'topic' => 'Chủ đề',
            'page' => 'Trang đơn',
            'custom' => 'Tùy biến',

        ];
        $title = 'Tất Cả Menu';
        return view("backend.menu.index", compact('list_menu', 'title', 'list_category', 'list_brand', 'list_topic', 'list_page', 'list_type'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (isset($request->DELETE_ALL)) {

            if (isset($request->checkId)) {
                $list_id = $request->input('checkId');
                $count_max = sizeof($list_id);
                $count = 0;
                foreach ($list_id as $id) {
                    $menu = Menu::find($id);
                    if ($menu == null) {
                        return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => "Có mẫu tin không tồn tại!Đã xóa $count/$count_max ! "]);
                    }
                    $menu->status = 0;
                    $menu->updated_at = date('Y-m-d H:i:s');
                     $menu->updated_by =2;
                    $menu->save();
                    $count++;
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => "Xóa thành công $count/$count_max !&& Vào thùng rác để xem!!!"]);
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => "Chưa chọn mẫu tin!!"]);
            }
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (isset($request->AddCategory)) {
            if (isset($request->categoryId)) {
                $list_id = $request->categoryId;
                foreach ($list_id as $id) {
                    $category = Category::find($id);
                    $menu = new Menu();
                    $menu->name = $category->name;
                    $menu->link = $category->slug;
                    $menu->type = 'category';
                    $menu->table_id = $id;
                    $menu->sort_order = 1;
                    $menu->position = $request->position;
                    $menu->parent_id = 0;
                    $menu->level = 1;
                    $menu->created_at = date('Y-m-d H:i:s');
                    $menu->created_by =1;
                    $menu->status = 2;
                    $menu->save();
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công!']);
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request->AddBrand)) {
            if (isset($request->brandId)) {
                $list_id = $request->brandId;
                foreach ($list_id as $id) {
                    $brand = Brand::find($id);
                    $menu = new Menu();
                    $menu->name = $brand->name;
                    $menu->link = $brand->slug;
                    $menu->type = 'brand';
                    $menu->table_id = $id;
                    $menu->sort_order = 1;
                    $menu->position = $request->position;
                    $menu->parent_id = 0;
                    $menu->level = 1;
                    $menu->created_at = date('Y-m-d H:i:s');
                   $menu->created_by =1;
                    $menu->status = 2;
                    $menu->save();
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công!']);
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request->AddTopic)) {
            if (isset($request->topicId)) {
                $list_id = $request->topicId;
                foreach ($list_id as $id) {
                    $topic = Topic::find($id);
                    $menu = new Menu();
                    $menu->name = $topic->name;
                    $menu->link = $topic->slug;
                    $menu->type = 'topic';
                    $menu->table_id = $id;
                    $menu->sort_order = 1;
                    $menu->position = $request->position;
                    $menu->parent_id = 0;
                    $menu->level = 1;
                    $menu->created_at = date('Y-m-d H:i:s');
                   $menu->created_by =1;
                    $menu->status = 2;
                    $menu->save();
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công!']);
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request->AddPage)) {
            if (isset($request->pageId)) {
                $list_id = $request->pageId;
                foreach ($list_id as $id) {
                    $page = Post::find($id);
                    $menu = new Menu();
                    $menu->name = $page->title;
                    $menu->link = $page->slug;
                    $menu->type = 'page';
                    $menu->table_id = $id;
                    $menu->sort_order = 1;
                    $menu->position = $request->position;
                    $menu->parent_id = 0;
                    $menu->level = 1;
                    $menu->created_at = date('Y-m-d H:i:s');
                   $menu->created_by =1;
                    $menu->status = 2;
                    $menu->save();
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công!']);
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request->AddCustom)) {
            $request->validate([
                'name' => 'required|max:255|min:5|string',
                'link' => 'required|min:1',
            ], [

                'name.required' => 'Tên là trường bắt buộc',
                'name.min' => 'Nhập ít nhất 5 ký tự',
                'name.string' => 'Tên phải là chuỗi chỉ chứa các ký tự chữ cái và số',

                'link.required' => 'link là trường bắt buộc',
                'link.min' => 'Nhập ít nhất 5 ký tự',

            ]);

            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->type = 'custom';
            $menu->sort_order = 1;
            $menu->position = $request->position;
            $menu->parent_id = 0;
            $menu->level = 1;
            $menu->created_at = date('Y-m-d H:i:s');
           $menu->created_by =1;
            $menu->status = 2;
            $menu->save();
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thêm thành công!']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $title = 'Chi Tiết Menu';
        return view("backend.menu.show", compact('title', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::where([['status', '!=', '0'], ['id', '=', $id]])->first();
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $title = 'Sửa Menu';
        $list = Menu::where([['status', '!=', '0'], ['id', '!=', $id]])
            ->orderBy('created_at', 'desc')->get();

        $html_sort_order = "";
        $html_parent_id = "";
        foreach ($list as $item) {

            $html_sort_order .= "<option value='" . ($item->sort_order + 1) . "'" . (($item->sort_order + 1 == old('sort_order', $menu->sort_order)) ? ' selected ' : ' ') . ">Sau: " . $item->name . "</option>";
            $html_parent_id .= "<option value='" . $item->id . "'" . (($item->id == old('parent_id', $menu->parent_id)) ? ' selected ' : ' ') . ">" . $item->name . "</option>";
        }
        return view("backend.menu.edit", compact('title', 'html_sort_order', 'menu', 'html_parent_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:255|min:1|string',
            'link' => 'required|min:1',
        ], [

            'name.required' => 'Tên là trường bắt buộc',
            'name.min' => 'Nhập ít nhất 5 ký tự',
            'name.string' => 'Tên phải là chuỗi chỉ chứa các ký tự chữ cái và số',

            'link.required' => 'link là trường bắt buộc',
            'link.min' => 'Nhập ít nhất 1 ký tự',

        ]);
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->sort_order = $request->sort_order;
        $menu->position = $request->position;
        $menu->parent_id = $request->parent_id;
        $menu->level = 1;
        $menu->updated_at = date('Y-m-d H:i:s');
         $menu->updated_by =2;
        $menu->status = $request->status;

        if ($menu->save()) {
            return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Cập nhật thành công!']);
        }
        return redirect()->route('menu.edit')->with('message', ['type' => 'danger', 'mgs' => 'Cập nhật thất bại!!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        }
        if ($menu->delete()) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'mgs' => 'Xóa vĩnh viễn thành công!']);
        }
        return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Xóa thất bại!']);
    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        }
        $menu->status = 0;
        $menu->updated_at = date('Y-m-d H:i:s');
         $menu->updated_by =2;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa thành công!&& vào thùng rác để xem!!!']);
    }
    public function trash()
    {
        $list_type = $this->list_type;
        //$list=Product::all();//try van tat ca
        $menu = Menu::where('status', '=', 0)->Orderby('updated_at', 'asc')->get();
        $title = 'Thùng rác menu';
        return view("backend.menu.trash", compact('menu', 'title', 'list_type'));
    }

    public function trashAll(Request $request)
    {

        if (isset($request['DELETE_ALL'])) {
            if (isset($request->checkId)) {
                $list_id = $request->input('checkId');

                $count_max = sizeof($list_id);
                $count = 0;
                foreach ($list_id as $id) {
                    $menu = Menu::find($id);
                    if ($menu == null) {
                        return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => "Có mẫu tin không tồn tại!&&Đã xóa $count/$count_max !"]);
                    }
                    if ($menu->delete()) {
                        $count++;
                    }
                }
                return redirect()->route('menu.trash')->with('message', ['type' => 'success', 'mgs' => "Xóa vĩnh viễn thành công $count/$count_max !"]);
            } else {
                return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
        if (isset($request['RESTORE_ALL'])) {
            if (isset($request->checkId)) {
                $list_id = $request->input('checkId');

                $count_max = sizeof($list_id);
                $count = 0;
                foreach ($list_id as $id) {
                    $menu = Menu::find($id);
                    if ($menu == null) {
                        return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => "Có mẫu tin không tồn tại!&&Đã phục hồi $count/$count_max !"]);
                    }

                    $menu->status = 2;
                    $menu->updated_at = date('Y-m-d H:i:s');
                     $menu->updated_by =2;
                    $menu->save();
                    $count++;
                }
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => "Phục hồi thành công $count/$count_max !"]);
            } else {
                return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Chưa chọn mẫu tin!']);
            }
        }
    }
    public function restore($id)
    {

        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        }

        $menu->status = 2;
        $menu->updated_at = date('Y-m-d H:i:s');
         $menu->updated_by =2;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Phục hồi thành công!']);
    }
    public function status($id)
    {

        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại!']);
        }
        $list_type = $this->list_type;
        $list_type = $list_type[$menu->type];
        if ($menu->type == 'custom') {
            $menu->status = ($menu->status == 1) ? 2 : 1;
        } else {
            $typeTable = Str::studly($menu->type); // Chuyển đổi tên bảng sang dạng StudlyCase
            $type = DB::table($typeTable)->where('id', $menu->table_id)->first();
            if ($type->status == 1) {
                $menu->status = ($menu->status == 1) ? 2 : 1;
            } else {
                return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => "Bạn cần thay đổi trạng thái $list_type  trước!!!"]);
            }
        }


        $menu->updated_at = date('Y-m-d H:i:s');
         $menu->updated_by =2;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công!']);
    }
}
