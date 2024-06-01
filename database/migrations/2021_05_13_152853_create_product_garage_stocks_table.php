<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGarageStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_garage_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->integer('stock');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_garage_stocks');
    }
}
