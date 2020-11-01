<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('pkey')->unique();
            $table->string('logo')->default('logo.png');
            $table->string('live_public_key')->nullable();
            $table->string('live_secret_key')->nullable();
            $table->string('test_public_key')->nullable();
            $table->string('test_secret_key')->nullable();
            $table->string('mode')->default('test');
            $table->string('status')->default('inactive');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('payment_methods');
    }
}
