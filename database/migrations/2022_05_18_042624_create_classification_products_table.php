<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classification_products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('secondary_classification_id')->unsigned();
            $table->foreign('secondary_classification_id')->references('id')->on('secondray_classifications')->onDelete('cascade');

        });
    }


    public function down()
    {
        Schema::dropIfExists('classification_products');
    }
};
