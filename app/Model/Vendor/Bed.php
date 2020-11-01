<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable=[
    	'room_id',
    	'bed_number',
    	'bed_price',
    	'isExtraBed',
    	'bed_type_id',
    	'adult',
    	'child'
    ];
    public function bed_type(){
    	return $this->belongsTo(BedType::class);
    }

    
    
}

