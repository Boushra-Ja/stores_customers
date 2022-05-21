<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('image')->nullable();
            $table->String('discription');
            $table->String('email');
            $table->String('facebook')->nullable();
            $table->String('num_of_salling');
            $table->String('status');
            //$table->String('address');
            $table->bigInteger('mobile')->nullable();
            $table->string('password');
            $table->timestamps();



        });
    }



    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
