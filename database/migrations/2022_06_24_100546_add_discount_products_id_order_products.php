<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->integer('discount_products_id')->unsigned();
            $table->foreign('discount_products_id')->references('id')->on('discount_products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn('discount_products_id');
        });
    }
};
