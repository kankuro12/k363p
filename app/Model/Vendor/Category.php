<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
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
    protected $fillable=['name','description','slug','status'];
}
