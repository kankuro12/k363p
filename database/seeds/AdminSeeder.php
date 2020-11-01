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
        	'name'=>'Abtest Abtest',
        	'email'=>'abtest@needtechnosoft.com.np',
        	'password'=>bcrypt('admin@123'),
            'active'=>1,
        	'remember_token'=>str_random(10),
        ]);
    }
}
