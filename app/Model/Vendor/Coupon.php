<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $dates=['start_time','end_time'];

    public function coupon_setting(){
    	return $this->hasOne(CouponSetting::class);
    }
}
