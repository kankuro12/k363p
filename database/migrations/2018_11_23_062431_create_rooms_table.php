<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('roomtype_id')->unsigned();
            $table->string('slug')->unique();
            $table->integer('no_of_rooms');
            $table->integer('vacant_rooms')->nullable();            
            $table->double('price',8, 2);
            $table->double('discount',8, 2)->nullable();
            $table->string('status')->default('UnAvailable');
            $table->integer('coupon_enabled')->nullable();
            $table->integer('exta_bed')->nullable();
            $table->double('price_of_extra_bed',8, 2)->nullable();
            $table->text('description');
            $table->integer('vendor_id')->unsigned();
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
