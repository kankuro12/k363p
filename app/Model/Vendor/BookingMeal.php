<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class BookingMeal extends Model
{
    protected $guarded=[];

    public function meal(){
    	return $this->belongsTo(Meal::class);
    }
}
