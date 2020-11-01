<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentMethod;
use File;
use App\FileUpload;
class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods=PaymentMethod::all();
        return view('admin.payment_methods.index',compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_methods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'live_secret_key'=>'required',
            'live_public_key'=>'required',
            'test_secret_key'=>'required',
            'test_public_key'=>'required',
            'description'=>'required',
            'mode'=>'required',
            'status'=>'required',
            'pkey'=>'required',
        ]);
        $payment_method=new PaymentMethod();
        $payment_method->name=$request->name;
        $payment_method->live_public_key=$request->live_public_key;
        $payment_method->live_secret_key=$request->live_secret_key;
        $payment_method->test_public_key=$request->test_public_key;
        $payment_method->test_secret_key=$request->test_secret_key;
        $payment_method->mode=$request->mode;
        $payment_method->pkey=$request->pkey;
        $payment_method->status=$request->status;
        $payment_method->description=$request->description;
        if($request->hasFile('logo')){
            $payment_method->logo=FileUpload::photo($request,'logo','','uploads/admin/payment_methods/logos',[[200,200]]);
        }
        $payment_method->save();
        session()->flash('msg','New Payment method has beed successfully added.');
        return redirect()->route('admin.get_payment_mode');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pm=PaymentMethod::find($id);
        return view('admin.payment_methods.show',compact('pm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pm=PaymentMethod::find($id);
        return view('admin.payment_methods.edit',compact('pm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'live_secret_key'=>'required',
            'live_public_key'=>'required',
            'test_secret_key'=>'required',
            'test_public_key'=>'required',
            'description'=>'required',
            'mode'=>'required',
            'status'=>'required',
        ]);
        $payment_method=PaymentMethod::find($id);
        $payment_method->name=$request->name;
        $payment_method->live_public_key=$request->live_public_key;
        $payment_method->live_secret_key=$request->live_secret_key;
        $payment_method->test_public_key=$request->test_public_key;
        $payment_method->test_secret_key=$request->test_secret_key;
        $payment_method->mode=$request->mode;
        $payment_method->status=$request->status;
        $payment_method->description=$request->description;
        if($request->hasFile('logo')){
            if(File::exists('uploads/admin/payment_methods/logos/'.$payment_method->logo) && $payment_method->logo!='logo.png'){
                unlink('uploads/admin/payment_methods/logos/'.$payment_method->logo);
                unlink('uploads/admin/payment_methods/logos/200x200/'.$payment_method->logo);
            }
            $payment_method->logo=FileUpload::photo($request,'logo','','uploads/admin/payment_methods/logos',[[200,200]]);
        }
        $payment_method->save();
        session()->flash('msg','Payment method has beed successfully updated.');
        return redirect()->route('admin.get_payment_mode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pm=PaymentMethod::where('id',$id)->firstOrFail();
        if(File::exists('uploads/admin/payment_methods/logos/'.$pm->logo) && $pm->logo!='logo.png'){
            unlink('uploads/admin/payment_methods/logos/'.$pm->logo);
            unlink('uploads/admin/payment_methods/logos/200x200/'.$pm->logo);
        }
        $pm->delete();
        session()->flash('msg','Payment Method has beed successfully removed.');
        return redirect()->route('admin.get_payment_mode');
    }
}
