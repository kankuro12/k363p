<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$c1=[
        	'name'=>$name='Nepal',
        	'country_code'=>'NP',
        	'slug'=>str_slug($name),
            'country_currency'=>'NPR',
            'created_at'=>'2018-01-12 03:33:57',
        ];
        $c2=[
        	'name'=>$name='India',
        	'country_code'=>'IN',
        	'slug'=>str_slug($name),
            'country_currency'=>'INR',
            'created_at'=>'2018-01-12 03:33:57',
        ];
        $c3=[
        	'name'=>$name='Pakistan',
        	'country_code'=>'PK',
        	'slug'=>str_slug($name),
            'country_currency'=>'PKR',
            'created_at'=>'2018-01-12 03:33:57',
        ];
        $c4=[
        	'name'=>$name='Bhutan',
        	'country_code'=>'BT',
        	'slug'=>str_slug($name),
            'country_currency'=>'Nu',
            'created_at'=>'2018-01-12 03:33:57',
        ];
        
    	
    	
        \App\Model\Vendor\Country::create($c1);
        \App\Model\Vendor\Country::create($c2);
        \App\Model\Vendor\Country::create($c3);
        \App\Model\Vendor\Country::create($c4);
    }
}
