<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutbounditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbounditems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outbond_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->string('product_code');
            $table->string('product_name');
            $table->timestamps();
            $table->foreign('outbond_id')->references('id')->on('outbounds')->onDelete('cascade');
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
        Schema::dropIfExists('outbounditems');
    }
}
