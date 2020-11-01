<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\VendorAccount;
use App\Model\Vendor\Vendor;
use File;
use App\FileUpload;
use Auth;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_accounts=VendorAccount::latest()->get();
        return view('admin.accounts.index',compact('vendor_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors=Vendor::all();
        return view('admin.accounts.create',compact('vendors'));
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
            'vendor_id'=>'required',
            'bill_no'=>'required',
            'title'=>'required',
            'ammount'=>'required'
        ]);
        $account=new VendorAccount();
        $account->title=$request->title;
        $account->invoice_number=$request->bill_no;
        $account->vendor_id=$request->vendor_id;
        $account->ammount=$request->ammount;
        $account->description=$request->description;
        $account->taken_by=Auth::guard('admin')->user()->id;
        if($request->hasFile('bill')){
            $account->bill=FileUpload::photo($request,'bill','','uploads/vendor/accounts/bills',[[200,200]]);
        }
        $account->save();
        session()->flash('msg','New account has beed successfully added.');
        return redirect()->route('admin.get_accounts');

        $account->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account=VendorAccount::where('id',$id)->firstOrFail();
        return view('admin.accounts.show',compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account=VendorAccount::where('id',$id)->firstOrFail();
        $vendors=Vendor::all();
        return view('admin.accounts.edit',compact('account','vendors'));
        
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
            'vendor_id'=>'required',
            'bill_no'=>'required',
            'title'=>'required',
            'ammount'=>'required'
        ]);
        $account=VendorAccount::find($id);
        $account->title=$request->title;
        $account->invoice_number=$request->bill_no;
        $account->vendor_id=$request->vendor_id;
        $account->ammount=$request->ammount;
        $account->description=$request->description;
        $account->taken_by=Auth::guard('admin')->user()->id;
        if($request->hasFile('bill')){
            if(File::exists('uploads/vendor/accounts/bills/'.$account->bill)){
                unlink('uploads/vendor/accounts/bills/'.$account->bill);
                unlink('uploads/vendor/accounts/bills/200x200/'.$account->bill);
            }
            $account->bill=FileUpload::photo($request,'bill','','uploads/vendor/accounts/bills',[[200,200]]);
        }
        $account->save();
        session()->flash('msg','Account has beed successfully updated.');
        return redirect()->route('admin.get_accounts');

        $account->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account=VendorAccount::where('id',$id)->firstOrFail();
        if(File::exists('uploads/vendor/accounts/bills/'.$account->bill)){
            unlink('uploads/vendor/accounts/bills/'.$account->bill);
            unlink('uploads/vendor/accounts/bills/200x200/'.$account->bill);
        }
        $account->delete();
        session()->flash('msg','Account has beed successfully deleted.');
        return redirect()->route('admin.get_accounts');
    }
}
