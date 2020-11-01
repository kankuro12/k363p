<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->integer('adult')->nullable();
            $table->integer('children')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('booking_id');
            $table->integer('num_rooms');


            $table->integer('room_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->date('check_in_time');
            $table->date('check_out_time'); 
            $table->boolean('coupon_applied')->default(0);
            $table->integer('coupon_id')->nullable();  
            $table->dateTime('approved_time')->nullable();
            $table->string('booking_status')->default('pending');

            $table->double('new_price',8, 2)->nullable();
            $table->double('old_price',8, 2)->nullable();
            $table->string('type')->nullable();
            $table->text('payment_addition_info')->nullable();
            $table->string('payment_status')->default('unpaid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
