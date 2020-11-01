<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourismAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourism_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by_admin')->default(1);
            $table->integer('creator_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('featured_image');
            $table->text('description');
            $table->string('location');
            $table->integer('created_by');
            $table->double('lat',10,5)->unsigned()->nullable();
            $table->double('lng',10,5)->unsigned()->nullable();
            $table->string('status')->default('inactive');
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
        Schema::dropIfExists('tourism_areas');
    }
}
