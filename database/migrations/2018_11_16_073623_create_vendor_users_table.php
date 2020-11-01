<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('fname');
            $table->string('lname');
            $table->string('slug')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('profile_img')->default('profile.png');
            $table->string('cover_img')->default('cover.png');
            $table->string('secondary_email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tripadvisor_url')->nullable();
            $table->string('location')->nullable();
            $table->integer('city_id')->nullable();
            $table->double('lat',10,5)->unsigned()->nullable();
            $table->double('lng',10,5)->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_users');
    }
}
