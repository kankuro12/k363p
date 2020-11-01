<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable=[
    	'name',
    	'price',
    	'status',
    	'description',
    	'vendor_id'
    ];
}
