<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class RoomAmentiy extends Model
{
	protected $table='room_amenities';

    protected $fillable=[
    	'room_id',
    	'amenity',
    	'status'
    ];
}


