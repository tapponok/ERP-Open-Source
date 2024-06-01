<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockopnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockopnames', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->longText('notes')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('canceled_by')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('canceled_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('canceled_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('stockopnames');
    }
}
