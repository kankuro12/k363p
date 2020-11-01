<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Model\VendorUser\VendorUser;
class Booking extends Model
{
    protected $fillable=[];

    public function room(){
    	return $this->belongsTo(Room::class);
    }
    public function city(){
    	return $this->belongsTo(City::class);
    }
    public function vendoruser(){
    	return $this->belongsTo(VendorUser::class,'user_id');
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
    public function meals(){
        return $this->hasMany(BookingMeal::class);
    }
    public function crooms(){
        return $this->hasMany(BookingChildRoom::class);
    }
    public function payment(){
        return $this->hasOne(BookingPayment::class);
    }
    public function review(){
        return $this->hasOne(Review::class);
    }
}
