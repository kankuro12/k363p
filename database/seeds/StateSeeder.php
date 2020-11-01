<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	$c1=[
            	'name'=>$name='Province No. 1',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c2=[
            	'name'=>$name='Province No. 2',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c3=[
            	'name'=>$name='Province No. 3',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c4=[
            	'name'=>$name='Gandaki Pradesh',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c5=[
            	'name'=>$name='Province No. 5',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c6=[
            	'name'=>$name='Province No. 6',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c7=[
            	'name'=>$name='Province No. 7',
            	'slug'=>str_slug($name),
            	'country_id'=>1,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c6=[
            	'name'=>$name='Andaman and Nicobar Islands',
            	'slug'=>str_slug($name),
            	'country_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c7=[
            	'name'=>$name='Andhra Pradesh',
            	'slug'=>str_slug($name),
            	'country_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c8=[
            	'name'=>$name='Arunachal Pradesh',
            	'slug'=>str_slug($name),
            	'country_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c9=[
            	'name'=>$name='Assam',
            	'slug'=>str_slug($name),
            	'country_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];
            $c10=[
            	'name'=>$name='Bihar',
            	'slug'=>str_slug($name),
            	'country_id'=>2,
                'created_at'=>'2018-01-12 03:33:57',
            ];          
        	
        	
            \App\Model\Vendor\State::create($c1);
            \App\Model\Vendor\State::create($c2);
            \App\Model\Vendor\State::create($c3);
            \App\Model\Vendor\State::create($c4);
            \App\Model\Vendor\State::create($c5);
            \App\Model\Vendor\State::create($c6);
            \App\Model\Vendor\State::create($c7);
            \App\Model\Vendor\State::create($c8);
            \App\Model\Vendor\State::create($c9);
            \App\Model\Vendor\State::create($c10);
    }
}
