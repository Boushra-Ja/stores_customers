<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persone_id')->unsigned();
            $table->foreign('persone_id')->references('id')->on('persones')->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
