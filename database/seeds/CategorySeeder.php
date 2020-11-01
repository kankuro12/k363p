<?php

use Illuminate\Database\Seeder;
use App\Model\Vendor\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1="Hotel";
        $type2="Restaurant/Cafe";
        Category::create([
            'name'=>$type1,
            'slug'=>str_slug($type1),
            'status'=>'active',
            'created_at'=>'2018-01-12 03:33:57',
        ]);
        Category::create([
            'name'=>$type2,
            'slug'=>str_slug($type2),
            'status'=>'active',
            'created_at'=>'2018-01-15 03:33:57',
        ]);
    }
}
