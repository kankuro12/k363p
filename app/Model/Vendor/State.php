<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
class State extends Model
{
	protected $guarded=[];
    public function country(){
    	return $this->belongsTo(Country::class);
    }
    public function cities(){
        return $this->hasMany(City::class);
    }
    
}
