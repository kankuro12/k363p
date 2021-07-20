<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class TourismArea extends Model
{
	use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $fillable=[
        'created_by_admin',
        'creator_id',
        'name',
        'slug',
        'featured_image',
        'description',
        'location',
        'created_by',
        'lat',
        'lng',
        'status'
    ];


}
