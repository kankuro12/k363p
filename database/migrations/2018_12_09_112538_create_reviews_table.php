<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->integer('vendor_user_id')->unsigned();
            $table->integer('booking_id')->unsigned();
            $table->string('review_title');
            $table->text('review_description');
            $table->double('clean');
            $table->double('food');
            $table->double('comfort');
            $table->double('facility');
            $table->double('sbehaviour');
            $table->double('avg_rating');
            $table->string('status')->default('unapproved');
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('vendor_user_id')->references('id')->on('vendor_users')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
