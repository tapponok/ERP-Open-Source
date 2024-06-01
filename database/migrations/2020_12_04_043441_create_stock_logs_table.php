cascade<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('product_id');
            $table->integer('laststock');
            $table->string('tabel_name');
            $table->string('table_data_id');
            $table->string('type');
            $table->integer('stock_in_process');
            $table->integer('newstock');
            $table->boolean('isarchive')->default(0);
            $table->string('trigger')->nullable();
            // $table->foreignId('created_by')->constrained();
            // $table->foreignId('product_id')->constrained();
            $table->foreign('created_by')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete();
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
        Schema::dropIfExists('stock_logs');
    }
}
