<?php

namespace App\Model\Vendor;
use App\Model\VendorUser\VendorUser;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $fillable=[
		'vendor_id',
		'review_title',
		'review_description',
		'clean',
		'food',
		'comfort',
		'facility',
        'avg_rating', 
        'sbehaviour',
        'booking_id',   

	];
    public function vendor_user(){
    	return $this->belongsTo(VendorUser::class);
    }
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function all_rating(){ 
        $average=0;        
        $average=($this->clean+$this->food+$this->comfort+$this->facility)/4; 
        return number_format((float)$average, 1, '.', '');
    }
    public function rating(){ 
        $average=0; 
        if($this->status=="approved"){
          $average=($this->clean+$this->food+$this->comfort+$this->facility)/4;        	
        }
    	return number_format((float)$average, 1, '.', '');
    }
    
}
