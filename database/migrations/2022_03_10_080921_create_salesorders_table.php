<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesorders', function (Blueprint $table) {
            $table->id();
            $table->string('salesorder_code');
            $table->date('estimate_date')->nullable();
            $table->unsignedBigInteger('partnership_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('total', 14, 2)->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('total_discount', 14, 2)->nullable();
            $table->decimal('tax_percent', 14, 2)->nullable();
            $table->decimal('tax_total', 14, 2)->nullable();
            $table->decimal('shipment_cost', 14, 2)->nullable();
            $table->decimal('total_charge', 14, 2)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('date_order')->nullable();
            $table->date('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('canceled_at')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->string('status')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('partnership_id')->references('id')->on('partnerships')->onDelete('cascade');
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
        Schema::dropIfExists('salesorders');
    }
}
