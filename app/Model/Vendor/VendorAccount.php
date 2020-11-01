<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class VendorAccount extends Model
{
    protected $guarded=[];

    public function vendor(){
    	return $this->belongsTo(Vendor::class);
    }
}
