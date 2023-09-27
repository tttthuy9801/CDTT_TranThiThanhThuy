<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Str;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;


use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='Danh sách sản phẩm';                                                                                                             #$title...
        $list = Slider::where('status','<>','0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.slider.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title ='Tạo';
        $list = Slider ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_sort_order = '';
        foreach($list as $item)
        {
            $html_sort_order .= "<option value ='' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
        }
        return view("backend.slider.create", compact('html_sort_order', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        $slider = new Slider();
        $slider ->name = $request->name;
        $slider ->link = $request->link;
        $slider ->position = "slideshow";
        //$slider ->level = $request->level;
        //$slider ->image = $request->image;
        $slider ->sort_order = $request->sort_order;
        $slider->created_at=date('Y-m-d H:i:s');
        $slider->created_by= 1;
        $slider->updated_by= 1;
        $slider->updated_at= date('Y-m-d H:i:s');
        $slider->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $slider ->slug. '.'.$extention;
                $file->move(public_path('images/slider'),$fileName);
                $slider->image = $fileName;
                //$brand ->image = $request->image;
             }
        }


        $slider->save();
        return redirect()->route('slider.index')->with('message',['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $row = Slider::find($id);                                                                                           //$row1=Slider::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.slider.show',compact('row','title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Slider::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Slider ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $html_sort_order = '';
        foreach($list as $item)
        {
            if($item->sort_order == $row->sort_order)
            {
                $html_sort_order .= "<option selected value =' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";            
            }
            else
            {
            $html_sort_order .= "<option value =' " . ($item->sort_order + 1) ."'>" .$item ->name . "</option>";
            }
        }
        $title = "Cập nhập mẫu tin";
        return view('backend.slider.edit',compact('row','title','list','html_sort_order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, string $id)
    {
        $row = Slider::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row ->name = $request->name;
        $row ->link = $request->link;
        $row ->position = "slideshow";
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row ->sort_order = $request->sort_order;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->updated_by= 1;
        $row->updated_at= date('Y-m-d H:i:s');
        $row->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $row ->slug. '.'.$extention;
                $file->move(public_path('images/slider'),$fileName);
                $row->image = $fileName;
                //$brand ->image = $request->image;
             }
        }
        $row->save();
        return redirect()->route('slider.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Slider::find($id);
        if($row == NULL)
        {
            return redirect()->route('slider.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('slider.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function trash()
    {                                                                                                        
        $list = Slider::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.slider.trash',compact('list'));
    }

    public function status($id)
    {
        $row = Slider::find($id);                                                                                           //$row1=Slider::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1; //phụ thuộc vào LOGIN
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái sản phẩm thành công']);
    }
    public function delete($id)
    {
        $row = Slider::find($id);                                                                                           //$row1=Slider::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1; //phụ thuộc vào LOGIN
        $row->status = 0;
        $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }


    public function restore($id)
    {
        $row = Slider::find($id);                                                                                           //$row1=Slider::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('slider.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = 1; //phụ thuộc vào LOGIN
        $row->status = 2;
        $row->save();
        return redirect()->route('slider.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục sản phẩm thành công']);
    }
    
}
