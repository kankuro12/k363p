<?php

namespace App\Model\Vendor;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Model\Vendor\Amenity;
use App\Model\Vendor\Gallery;
use App\Model\Vendor\Policy;
use App\Model\Vendor\Room;
use App\Model\Vendor\Category;
use App\Model\Vendor\Location;
use DB;
class Vendor extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
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
        'phone_number',
        'secondary_phone_number',
        'website',
        'category_id',
        'location_id',
        'average_cost',
        'logo',
        'cover_img',
        'secondary_email',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'tripadvisor_url',
        'description',
        'verified',
        'verified_time',
        'user_id',
        'featured',
        'lat',
        'lng',
        'star',
        'featured_start_time',
        'featured_end_time'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function amenities(){
        return $this->belongsToMany(Amenity::class);
    }
    public function amenityvendor(){
        return $this->hasMany(AmenityVendor::class);
    }
    public function galleries(){
        return $this->hasMany(Gallery::class);
    }
    public function policy(){
        return $this->hasOne(Policy::class);
    }
    public function location(){
        return $this->hasOne(Location::class,'vendor_id','id');
    }
    public function rooms(){
        return $this->hasMany(Room::class,'vendor_id');
    }

    public function roomTypeRooms(){
        $types=[];
        foreach(RoomType::all() as $roomtype){
            $data=Room::where(['vendor_id'=>$this->id,'roomtype_id'=>$roomtype->id])->get();
            if($data->count()>0){
                $types[$roomtype->name]=[
                    'data'=>$data,
                    'image'=>$roomtype->icon
                ];

            }
        }
        return $types;

    }


    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function meals(){
        return $this->hasMany(Meal::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class,'vendor_id','id');
    }
    public function coupons(){
        return $this->hasMany(Coupon::class,'vendorid');
    }
    public function top_rating() {
       return $this->reviews()->where('avg','>', 4);
    }
    public function average_review(){
        $avg_rating=0;
        $avg_clean=0;
        $avg_comfort=0;
        $avg_food=0;
        $avg_facility=0;
        $avg_sbehaviour=0;
        $num_of_active_reviews=$this->reviews()->where('status','approved')->count();
        $services=$this->rooms()->count();
        $num_div=$num_of_active_reviews*5;
        if($num_of_active_reviews>0){
            foreach ($this->reviews()->where('status','approved')->get() as $key => $review) {
              $avg_rating+=$review->rating();
              $avg_clean+=$review->clean;
              $avg_comfort+=$review->comfort;
              $avg_food+=$review->food;
              $avg_facility+=$review->facility;
              $avg_sbehaviour+=$review->sbehaviour;
            }
            $avg_rating=$avg_rating/$num_of_active_reviews;
            // $avg_clean=$avg_clean/$num_of_active_reviews;
            // $avg_comfort=$avg_comfort/$num_of_active_reviews;
            // $avg_food=$avg_food/$num_of_active_reviews;
            // $avg_facility=$avg_facility/$num_of_active_reviews;
        }
        $result=array();
        $result['avg_rating']=number_format((float)($avg_rating), 1, '.', '');
        $result['avg_clean']=$num_of_active_reviews==0?0:($avg_clean/$num_div)*100;
        $result['avg_comfort']=$num_of_active_reviews==0?0:($avg_comfort/$num_div)*100;
        $result['avg_food']=$num_of_active_reviews==0?0:($avg_food/$num_div)*100;
        $result['avg_sbehaviour']=$num_of_active_reviews==0?0:($avg_sbehaviour/$num_div)*100;
        $result['avg_facility']=$num_of_active_reviews==0?0:($avg_facility/$num_div)*100;
        $result['reviews']=$num_of_active_reviews;
        $result['services']=$services;
        return $result;
    }
    public static function vincentyGreatCircleDistanceold(
      $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
      // convert from degrees to radians
      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($latitudeTo);
      $lonTo = deg2rad($longitudeTo);

      $lonDelta = $lonTo - $lonFrom;
      $a = pow(cos($latTo) * sin($lonDelta), 2) +
        pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
      $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

      $angle = atan2(sqrt($a), $b);
      return  number_format((float)($angle * $earthRadius), 1, '.', '');
    }
    function vincentyGreatCircleDistance($lat1, $lon1, $lat2, $lon2, $unit='K'){
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K")
        {
            return ($miles * 1.609344);
        }
        else if ($unit == "N")
        {
        return ($miles * 0.8684);
        }
        else
        {
        return $miles;
      }
    }
}
