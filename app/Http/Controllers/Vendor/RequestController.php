<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Mail\Call;
use App\User;
use App\VendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    //
    public function index(Request $request){
        if($request->getMethod()=="POST"){
            $req=new VendorRequest();
            $req->name=$request->name;
            $req->address=$request->address;
            $req->owner=$request->owner;
            $req->phone=$request->phone;
            $req->email=$request->email;
            $req->save();
            $n=new User();
            $n->email=env('admin_email',"cms111000111@gmail.com");
            Mail::to($n)->send(new Call($req));
            return view("vendor.request.success",compact('req'));

        }else{
            return view("vendor.request.index");
        }
    }
}
