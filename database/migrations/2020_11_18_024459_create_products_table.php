<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('product_photo')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->dateTime('expired_date')->nullable();
            $table->integer('minimum_stock')->nullable();
            $table->integer('stock')->nullable();
            $table->decimal('selling_price', 14, 2)->nullable();
            $table->unsignedBigInteger('group_product_id')->nullable();
            $table->boolean('isarchive')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('group_product_id')->references('id')->on('group_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
