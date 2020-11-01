<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $fillable=['vendor_id','check_in_out_policy','cancelation_policy','extra_bed_policy','payment_mode','status','description','check_in_time','check_out_time'];
}


