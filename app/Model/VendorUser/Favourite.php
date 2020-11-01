<?php

namespace App\Model\VendorUser;

use Illuminate\Database\Eloquent\Model;
use App\Model\Vendor\Vendor;
class Favourite extends Model
{
    protected $fillable=[
    	'vendor_user_id',
    	'vendor_id'
    ];
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
