<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receive_order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('receive_order_id')->references('id')->on('receive_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receive_order_items');
    }
}
