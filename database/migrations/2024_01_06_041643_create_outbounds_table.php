<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->string('status')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('outbond_date')->nullable();
            $table->date('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('canceled_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outbounds');
    }
}
