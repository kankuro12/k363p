<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Coupon;
use App\Model\Vendor\CouponSetting;
use App\Model\Vendor\Room;
use Auth;
use Illuminate\Support\Facades\Input;
class CouponController extends Controller
{
    public function manageCoupon(){
    	$coupons=Auth::user()->vendor->coupons;
        return view('vendor.coupon.index',compact('coupons'));
    }
    public function addCoupon(){
        return view('vendor.coupon.create');
    }
    public function insertCoupon(Request $request){
        $this->validate($request,[
            'coupon_name'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'coupon_code'=>'required',
            'discount_type'=>'required'            

        ]);
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->start_time = $data['start_date'];
        $coupon->end_time = $data['end_date'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->vendorid=Auth::user()->vendor->id; 
        $coupon->status=1;
        $coupon->save();
        $couponsetting = new CouponSetting;
        $couponsetting->coupon_id = $coupon->id;
        $couponsetting->discount_type = $data['discount_type'];
        if($data['discount_type'] == 1){
            $couponsetting->discount_value = $data['discount_value'];
        }else{
            $couponsetting->discount_percent = $data['discount_percent'];
            $couponsetting->maximum_discount_value = $data['maximum_discount'];
        }
        $couponsetting->minimum_order_value = $data['minimum_order_value'];
        $couponsetting->issued_number_coupon = $data['issued_number_coupon'];
        //$couponsetting->limit_per_customer = $data['limit_per_customer'];
        $couponsetting->save();
        return redirect()->route('vendor.manage-coupon')->with('msg','Coupon has been added Successfully . . .');


    }
    public function assign_coupon($id){
        $coupon=Coupon::findOrFail($id);
        $vendor=Auth::user()->vendor;
        $rooms=$vendor->rooms;
        return view('vendor.coupon.assign_coupon',compact('coupon','rooms'));

    }
    public function post_assign_coupon(Request $request,$id){
        foreach($request->input('room_id') as $i => $room){
              $data = Room::findOrFail($room);
              $data->coupon_enabled = $request->input('coupon_status')[$i];
              $data->save();
        }
        return redirect()->route('vendor.manage-coupon')->with('msg','Coupon has been assigned Successfully . . .');
    }
    public function disable_coupon(Request $request,$id){
        $coupon=Coupon::where('id',$id)->where('vendorid',Auth::user()->vendor->id)->first();
        $coupon->status=0;
        $coupon->save();
        return redirect()->route('vendor.manage-coupon')->with('msg','Coupon has been successfully  disabled. . .');
    }
}
