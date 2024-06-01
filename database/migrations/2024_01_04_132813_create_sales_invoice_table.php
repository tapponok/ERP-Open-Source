<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->decimal('total_payment', 14, 2)->nullable();
            $table->decimal('total_down_payment', 14, 2)->nullable();
            $table->decimal('outstanding', 14, 2)->nullable();
            $table->foreign('sales_order_id')->references('id')->on('salesorders')->onDelete('cascade');
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
        Schema::dropIfExists('sales_invoice');
    }
}
