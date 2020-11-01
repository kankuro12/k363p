<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\FileUpload;
use Session;
use File;
class UsersController extends Controller
{
    public function index(){
    	$members=Admin::all();
    	return view('admin.members.index',compact('members'));
    }
    public function create(){
    	return view('admin.members.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
            'active'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input=$request->except('_token','password_confirmation');
        if($request->hasFile('avatar')){
           $input['avatar']=FileUpload::photo($request,'avatar','','uploads/admin/avatars',[[200,200]]);
        } 
        $input['password']=bcrypt($request->password);
        Admin::create($input);
        Session::flash('msg','New member has been successfully added.');
        return redirect()->route('admin.members');
    }
    public function edit($id){
        $user=Admin::where('id',$id)->firstOrFail();
        return view('admin.members.edit',compact('user'));
    }

    public function update(Request $request, $id){
        $user = Admin::find($id);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'email|unique:admins,email,'.$user->id,           
            'active'=>'required',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about'=>'max:1500',
        ]);
        $input=$request->except('_token','password_confirmation');
        if($request->hasFile('avatar')){
        	if(File::exists('uploads/admin/avatars/'.$user->avatar)){
        	    unlink('uploads/admin/avatars/'.$user->avatar);
        	    unlink('uploads/admin/avatars/200x200/'.$user->avatar);
        	}
           $input['avatar']=FileUpload::photo($request,'avatar','','uploads/admin/avatars',[[200,200]]);
        } 
        if($request->filled('password')){
            $input['password']=bcrypt($request->password);
        }
        $user=Admin::where('id',$id)->firstOrFail();
        $user->update($input);
        Session::flash('msg','Member has been successfully updated.');
        return redirect()->route('admin.members');
    }
}
