<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Model\Vendor\City;
use App\Model\Vendor\Vendor;
class Location extends Model
{
    protected $fillable=['name','city_id','lat','lng','vendor_id'];

    public function city(){
    	return $this->belongsTo(City::class);
    }
    public function vendors(){
    	return $this->hasMany(Vendor::class);
    }
}

