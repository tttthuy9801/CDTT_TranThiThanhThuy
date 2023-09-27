<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;    
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                       
        $title ='Danh sách thành viên';                                                                                                             #$title...
        $list = User::where('status','<>','0')->get();                                                                                       #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.user.index',compact('list','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = User::where('status','<>','0')->orderBy('created_at','desc')->get();  
       
        $title ='Tạo';
        return view("backend.user.create", compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreUserRequest $request)
    {
        $user=new User();
    
        $user->name=$request->name;
        $user->username= $request->username;
        $user->password=$request->password;
        $user->email=$request->email;
        $user->gender=$request->gender;
        $user->phone=$request->phone;
        $file=$request->file('image');
        if($file!=NULL)
        {
            $extension=$file->getClientOriginalExtension();
            if(in_array($extension,['png','jpg','webp','gif']))
            {
                $fileName=$user->slug.'.'.$extension;
                $file->move(public_path('images/user'),$fileName);
                $user->image=$fileName;
            }
        }
        $user->roles=$request->roles;
        $user->address=$request->address;
        $user->created_at=date('Y-m-n H:i:s');
        $user->created_by=1;
        $user->updated_at=date('Y-m-n H:i:s');
        $user->updated_by=1;
        $user->status=1;

        $user->save();
        return redirect()->route('user.index')->with('message',['type'=>'success','mgs'=>'Thêm thành công']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        {
            $row = User::find($id);                                                                                           //$row1=User::where([['id','=',$id],['status','!=',0]])..
            if($row == NULL)
            {
                return redirect()->route('post.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
            }
            $title = "Chi tiết thành viên";
            return view('backend.user.show',compact('row','title'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = user::find($id);                                                                                           //$row1=brand::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $list = user ::where('status','<>','0')->orderBy('created_at','desc')->get();  
$title = "Cập nhập mẫu tin";
        return view('backend.user.edit',compact('row','title'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateUserRequest $request,$id)
    {
        $row = user::find($id);                                                                                           //$row1=topic::where([['id','=',$id],['status','!=',0]])..
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        
        $row->name=$request->name;
        $row->username= $request->username;
        $row->password=$request->password;
        $row->email=$request->email;
        $row->gender=$request->gender;
        $row->phone=$request->phone;
        $file=$request->file('image');
        if($file!=NULL)
        {
            $extension=$file->getClientOriginalExtension();
            if(in_array($extension,['png','jpg','webp','gif']))
            {
                $fileName=$row->slug.'.'.$extension;
                $file->move(public_path('images/user'),$fileName);
                $row->image=$fileName;
            }
        }
        $row->roles=$request->roles;
        $row->address=$request->address;
        $row->created_at=date('Y-m-n H:i:s');
        $row->created_by=1;
        $row->updated_at=date('Y-m-n H:i:s');
        $row->updated_by=1;
        $row->status=1;


        $row->save();
        return redirect()->route('user.index')->with('message',['type' => 'success', 'mgs' => 'Cập nhập thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $row = User::find($id);
        if($row == NULL)
        {
            return redirect()->route('user.index')->with('message',['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->delete();
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);

    }
    public function trash()
    {                                                                                                        
        $list = User::where('status','=','0')->get();                                                                                   #orwhere la them 1 dieu kien nua {get lay nhieu mau tin} ['tenbien' => $list,'tieude' => $title]  ,compact($list)
        return view('backend.user.trash',compact('list'));
    }
    public function status($id)
    {
        $row = User::find($id);                                                                                           //$row1=User::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('user.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->save();
        return redirect()->route('user.index')->with('message', ['type' => 'success', 'mgs' => 'Thay đổi trạng thái sản phẩm thành công']);
    }
    public function delete($id)
    {
        $row = User::find($id);                                                                                           //$row1=User::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('user.index')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 0;
        $row->save();
        return redirect()->route('user.index')->with('message', ['type' => 'success', 'mgs' => 'Xóa sản phẩm thành công']);
    }


    public function restore($id)
    {
        $row = User::find($id);                                                                                           //$row1=User::where([['id','=',$id],['status','!=',0]])..
        if ($row == NULL) {
            return redirect()->route('user.trash')->with('message', ['type' => 'danger', 'mgs' => 'Mẫu tin không tồn tại']);
        }
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id(); //phụ thuộc vào LOGIN
        $row->status = 2;
        $row->save();
        return redirect()->route('user.trash')->with('message', ['type' => 'success', 'mgs' => 'Khôi phục sản phẩm thành công']);
    }
}