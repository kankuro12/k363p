<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	$c1=[
            	'name'=>$name='Biratngar',
            	'slug'=>str_slug($name),
            	'state_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c2=[
            	'name'=>$name='Dhankuta',
            	'slug'=>str_slug($name),
            	'state_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c3=[
            	'name'=>$name='Dharan',
            	'slug'=>str_slug($name),
            	'state_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c4=[
            	'name'=>$name='Itahari',
            	'slug'=>str_slug($name),
            	'state_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c5=[
            	'name'=>$name='Ilam',
            	'slug'=>str_slug($name),
            	'state_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c6=[
            	'name'=>$name='Janakpur',
            	'slug'=>str_slug($name),
            	'state_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c7=[
            	'name'=>$name='Rajbiraj',
            	'slug'=>str_slug($name),
            	'state_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c8=[
            	'name'=>$name='Lahan',
            	'slug'=>str_slug($name),
            	'state_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c6=[
            	'name'=>$name='Kathmandu',
            	'slug'=>str_slug($name),
            	'state_id'=>3,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c7=[
            	'name'=>$name='Lalitpur',
            	'slug'=>str_slug($name),
            	'state_id'=>3,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c8=[
            	'name'=>$name='Bhaktapur',
            	'slug'=>str_slug($name),
            	'state_id'=>3,
                'created_at'=>'2018-01-12 03:33:57',
            ];

            $c9=[
            	'name'=>$name='Bharatpur',
            	'slug'=>str_slug($name),
            	'state_id'=>3,
                'created_at'=>'2018-01-12 03:33:57',
            ];

            $c10=[
            	'name'=>$name='Hetauda',
            	'slug'=>str_slug($name),
            	'state_id'=>3,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c11=[
            	'name'=>$name='Birgunj',
            	'slug'=>str_slug($name),
            	'state_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];    
             $c12=[
            	'name'=>$name='Pokhara',
            	'slug'=>str_slug($name),
            	'state_id'=>4,
                'created_at'=>'2018-01-12 03:33:57',
            ];        	
            \App\Model\Vendor\City::create($c1);
            \App\Model\Vendor\City::create($c2);
            \App\Model\Vendor\City::create($c3);
            \App\Model\Vendor\City::create($c4);
            \App\Model\Vendor\City::create($c5);
            \App\Model\Vendor\City::create($c6);
            \App\Model\Vendor\City::create($c7);
            \App\Model\Vendor\City::create($c8);
            \App\Model\Vendor\City::create($c9);
            \App\Model\Vendor\City::create($c10);
            \App\Model\Vendor\City::create($c11);
            \App\Model\Vendor\City::create($c12);
    }
}
