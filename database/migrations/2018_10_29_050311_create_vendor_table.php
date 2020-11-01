<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('star')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phone_number');
            $table->string('secondary_phone_number')->nullable();
            $table->string('website')->nullable();
            $table->integer('category_id')->unsigned();
            // $table->integer('location_id')->unsigned()->nullable();
            $table->dateTime('featured_end_time')->nullable();
            $table->dateTime('featured_start_time')->nullable();
            $table->double('average_cost',2)->nullable();
            $table->string('logo')->default('logo.png');
            $table->string('cover_img')->default('cover.png');
            $table->string('secondary_email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tripadvisor_url')->nullable();
            $table->text('description')->nullable();
            $table->string('verified')->default(0);
            $table->boolean('featured_verified')->default(0);
            $table->string('featured')->default('inactive');
            $table->dateTime('verified_time')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
