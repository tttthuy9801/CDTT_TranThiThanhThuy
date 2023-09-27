<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;



class ProductController  extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                       
        $title ='Danh sách sản phẩm';      

        

        $list = Product::join('tttt_category', 'tttt_product.category_id', '=', 'tttt_category.id')
    ->join('tttt_brand', 'tttt_product.brand_id', '=', 'tttt_brand.id')
    ->where('tttt_product.status', '<>', '0')
    ->orderBy('tttt_product.status', 'desc') 
    ->select("tttt_product.*", "tttt_category.name as category_name", "tttt_brand.name as brand_name")
    ->get();
        return view('backend.product.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='Tạo';
        $category = Category ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $brand = Brand ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $list = Product ::where('status','<>','0')->orderBy('created_at','desc')->get();  

        $html_category_id = '';
        $html_brand_id = '';
        foreach($category as $item )
        {
            $html_category_id .= "<option value ='" . $item->id ."'>" .$item->name."</option>";
        }

        foreach($brand as $item )
        {
            $html_brand_id .= "<option value ='" . $item->id ."'>" .$item->name."</option>";
        }
        return view("backend.product.create", compact('html_category_id','html_brand_id', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $row = new Product();
        $row ->name = $request->name;
        $row ->slug = Str::of($request->name)->slug('-');;
        $row ->category_id = $request->category_id;
        $row ->brand_id = $request->brand_id;
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row ->metakey = $request->metakey;
        $row ->detail = $request->detail;
        $row ->qty = $request->qty;
        $row ->price = $request->price;
        $row ->pricesale = $request->pricesale;
        $row->metadesc=$request->metadesc;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $row ->slug. '.'.$extention;
                $file->move(public_path('images/product'),$fileName);
                $row->image = $fileName;
                //$product ->image = $request->image;
             }
        }


        $row->save();
        return redirect()->route('product.index')->with('message',['type' => 'success', 'mgs' => 'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $list = Product::join('tttt_category', 'tttt_product.category_id', '=', 'tttt_category.id')
    ->join('tttt_brand', 'tttt_product.brand_id', '=', 'tttt_brand.id')
    ->where('tttt_product.status', '<>', '0')
    ->orderBy('tttt_product.status', 'desc') 
    ->select("tttt_product.*", "tttt_category.name as category_name", "tttt_brand.name as brand_name")
    ->get();

            $row = Product::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('post.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mẫu tin";
            return view('backend.product.show',compact('row','title','list'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $row = Product::find($id);    
        $title ='Chỉnh sửa sản phẩm';                                                                                       
        $category = Category ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $brand = Brand ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        $list = Product ::where('status','<>','0')->orderBy('created_at','desc')->get();  

        $html_category_id = '';
        $html_brand_id = '';
        foreach($category as $item )
        {
            $html_category_id .= "<option value ='" . $item->id ."'>" .$item->name."</option>";
        }

        foreach($brand as $item )
        {
            $html_brand_id .= "<option value ='" . $item->id ."'>" .$item->name."</option>";
        }
        return view("backend.product.edit", compact('html_category_id','html_brand_id', 'title','row'));
    }
       

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $row = Product::find($id); 
        $row ->name = $request->name;
        $row ->slug = Str::of($request->name)->slug('-');;
        $row ->category_id = $request->category_id;
        $row ->brand_id = $request->brand_id;
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row ->metakey = $request->metakey;
        $row ->detail = $request->detail;
        $row ->qty = $request->qty;
        $row ->price = $request->price;
        $row ->pricesale = $request->pricesale;
        $row->metadesc=$request->metadesc;
        $row->created_at=date('Y-m-d H:i:s');
        $row->created_by= 1;
        $row->status=2;
        
        $file = $request->file('image');
        if($file!= NULL)
        {
            var_dump('file');
             $extention = $file ->getClientOriginalExtension();
             if(in_array($extention, ['png', 'jpg']))
             {
                $fileName = $row ->slug. '.'.$extention;
                $file->move(public_path('images/product'),$fileName);
                $row->image = $fileName;
                //$product ->image = $request->image;
             }
        }


        $row->save();
        return redirect()->route('product.index')->with('message',['type' => 'success', 'mgs' => 'Sửa thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    
    public function destroy($id)
    {
        $row = Product::find($id);
        if($row == NULL)
        {
            return redirect()->route('product.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('product.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function trash()
    {                                                                                                        
        $list = Product::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.product.trash',compact('list'));
    }

    public function delete($id)
    {
        $row = Product::find($id);
        if($row == NULL)
        {
            return redirect()->route('product.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at=date('Y-m-d H:i:s');
        $row->updated_by=Auth::id();
        $row->status=0;
        $row->save();
        return redirect()->route('product.index')->with('message',['type' => 'success', 'mgs' => 'Xóa thành công']);
    }

    public function restore($id)
    {
        $row = Product::find($id);
        if($row == NULL)
        {
            return redirect()->route('product.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at=date('Y-m-d H:i:s');
        $row->updated_by=Auth::id();
        $row->status=2;
        $row->save();
        return redirect()->route('product.index')->with('message',['type' => 'success', 'mgs' => 'Khôi phục thành công']);
    }

    public function status($id)
    {
        $row = Product::find($id);
        if($row == NULL)
        {
            return redirect()->route('product.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at=date('Y-m-d H:i:s');
        $row->updated_by=Auth::id();
        $row->status=($row->status==1)?2:1;
        $row->save();
        return redirect()->route('product.index')->with('message',['type' => 'success', 'mgs' => 'Thay đổi trạng thái thành công']);
    }
}
