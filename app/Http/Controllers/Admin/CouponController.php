<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Coupon;
use App\Model\Vendor\CouponSetting;
class CouponController extends Controller
{
    public function manageCoupon(){
        $coupons = Coupon::get();
        return view('admin.coupon.index',compact('coupons'));
    }
    public function addCoupon(){
        return view('admin.coupon.create');
    }
    public function insertCoupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->start_time = $data['start_date'];
        $coupon->end_time = $data['end_date'];
        $coupon->coupon_code = $data['coupon_code']; 
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
        $couponsetting->limit_per_customer = $data['limit_per_customer'];
        $couponsetting->save();
        return redirect()->route('admin.manage-coupon')->with('msg','Coupon has been added Successfully . . .');


    }
}
