<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('check_in_time');
            $table->string('check_out_time');
            $table->string('check_out_policy');
            $table->string('cancelation_policy');
            $table->string('children_bed_policy');
            $table->string('pet_policy');
            $table->string('group_policy');
            $table->string('payment_policy');
            $table->integer('room_id')->unsigned();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_policies');
    }
}
