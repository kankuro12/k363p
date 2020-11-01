<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
        	'name'=>'Khadga Shretstha',
        	'email'=>'admin@admin.com',
        	'password'=>bcrypt('lovethecode'),
            'active'=>1,
        	'remember_token'=>str_random(10),
        ]);
    }
}
