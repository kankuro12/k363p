<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class RoomPolicy extends Model
{
    protected $fillable=[
    	'check_in_time',
    	'check_out_time',
    	'check_out_policy',
    	'cancelation_policy',
    	'children_bed_policy',
    	'pet_policy',
    	'group_policy',
    	'payment_policy',
    ];
}
