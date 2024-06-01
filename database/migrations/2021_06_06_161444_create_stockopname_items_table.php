<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockopnameItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockopname_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stockopname_id')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('laststock');
            $table->integer('newstock');
            $table->longText('notes')->nullable();
            $table->foreign('stockopname_id')->references('id')->on('stockopnames')->onDelete('cascade');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('stockopname_items');
    }
}
