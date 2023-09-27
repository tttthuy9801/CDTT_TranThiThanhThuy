<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreOrderRequest;

use App\Http\Requests\UpdateOrderRequest;

use Illuminate\Support\Str;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='Danh sách đơn hàng';                                                                                                             #$title...
        $list = Order::where('status','<>','0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.order.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $title ='Tạo';
        $list = Order ::where('status','<>','0')->orderBy('created_at','desc')->get();  
        return view("backend.order.create", compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $order ->code = $request->code;
        $order ->user_id = $request->user_id;
        $order ->exportdate = $request->exportdate;
        //$order ->level = $request->level;
        //$order ->image = $request->image;
        $order->deliveryaddress = $request->deliveryaddress;
        $order->deliveryname=$request->deliveryname;
        $order->deliveryphone=$request->deliveryphone;
        $order->deliveryemail=$request->deliveryemail;
        $order->created_at=date('Y-m-d H:i:s');
        $order->status=2;


        $order->save();
        return redirect()->route('order.index')->with('message',['type' => 'success', 'mgs' => 'Thêm thành công']);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $row = Order::find($id);                                                                                           //$row1=Category::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('order.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết mãu tin";
            return view('backend.order.show',compact('row','title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $row = Order::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('order.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = Order ::where('status','<>','0')->orderBy('created_at','desc')->get();  


        $title = "Cập nhập mẫu tin";
        return view('backend.order.edit',compact('row','title',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        $row = Order::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('order.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }

        $row ->code = $request->code;
        $row ->user_id = $request->user_id;
        $row ->exportdate = $request->exportdate;
        //$row ->level = $request->level;
        //$row ->image = $request->image;
        $row->deliveryaddress = $request->deliveryaddress;
        $row->deliveryname=$request->deliveryname;
        $row->deliveryphone=$request->deliveryphone;
        $row->deliveryemail=$request->deliveryemail;
        $row->created_at=date('Y-m-d H:i:s');
        $row->status=2;

        $row->save();
        return redirect()->route('order.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = Order::find($id);
        if($row == NULL)
        {
            return redirect()->route('order.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('order.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function trash()
    {                                                                                                        
        $list = Order::where('status','=','0')->orderBy('created_at','asc')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.order.trash',compact('list'));
    }
}
