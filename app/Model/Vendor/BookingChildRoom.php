<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class BookingChildRoom extends Model
{
    protected $guarded=[];

    public function childroom(){
    	return $this->belongsTo(ChildRoom::class,'child_rooms_id');
    }
}
