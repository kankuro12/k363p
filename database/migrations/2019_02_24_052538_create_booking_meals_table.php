<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->integer('meal_id');
            $table->integer('meal_value');
            $table->double('meal_price');
            $table->text('over_all');
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
        Schema::dropIfExists('booking_meals');
    }
}
