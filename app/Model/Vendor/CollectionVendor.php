<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class CollectionVendor extends Model
{
    protected $fillable=['vendor_id','collection_id'];

    public function vendor(){
    	return $this->belongsTo(Vendor::class);
    }
}
