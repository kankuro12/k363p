<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable=['photo','status','vendor_id','caption'];
}
