<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Room extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable=[
    	'name',
        'slug',
    	'roomtype_id',
    	'smooking_policy',
    	'room_size',
    	'room_size_type',
    	'price',
    	'discount',
    	'status',
    	'isExtraBed',
    	'exta_bed',
    	'price_of_extra_bed',
    	'description',
        'no_of_rooms',
        'coupon_enabled',
        'vacant_rooms'

    ];
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
    public function roomtype(){
        return $this->belongsTo(RoomType::class);
    }
    public function roomamenities(){
        return $this->hasMany(RoomAmentiy::class);
    }
    public function childrooms(){
        return $this->hasMany(ChildRoom::class);
    }
    public function roomphotos(){
        return $this->hasMany(RoomPhoto::class,'room_id');
    }
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
    public function roompolicy(){
        return $this->hasOne(RoomPolicy::class);
    }
    public function beds(){
        return $this->hasMany(Bed::class);
    }
    public function getNewPrice(){
        $discount=$this->price*$this->discount/100;
        return $this->price-$discount;
    }
    public function get_num_bed(){        
        return null;
    }
    public function bed_details(){
        $ab=0;
        $cb=0;
        foreach ($this->beds as $key => $bed) {
          $ab+=$bed->adult;
          $cb+=$bed->child;            
        }
        return $ab." Adult ".$cb." Child";
    }
    public function get_adult_beds(){
        $adult_bed=0;
        $child_bed=0;
        foreach ($this->beds as $key => $bed) {
            $adult_bed+=$bed->adult;
            $child_bed+=$bed->child;
        }
        $result=array();
        $result['adult_bed']=$adult_bed;
        $result['child_bed']=$child_bed;
        return $result;        
    }
}
