<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesorderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesorder_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salesorder_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->string('product_code');
            $table->string('product_name');
            $table->decimal('price', 13, 2)->default(0);
            $table->decimal('discount_percentage')->default(0);
            $table->decimal('discounttotal', 13, 2)->default(0);
            $table->decimal('subtotal', 13, 2)->default(0);
            $table->decimal('total_after_discount', 13, 2)->default(0);
            $table->boolean('isarchive')->default(0);
            $table->timestamps();
            $table->foreign('salesorder_id')->references('id')->on('salesorders')->onDelete('cascade');
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
        Schema::dropIfExists('salesorder_items');
    }
}
