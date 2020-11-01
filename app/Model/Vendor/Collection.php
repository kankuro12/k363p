<?php

namespace App\Model\Vendor;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Collection extends Model
{
    protected $fillable=['name','description','status','image'];

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
    public function collectionvendors(){
    	return $this->hasMany(Collectionvendor::class);
    }
}
