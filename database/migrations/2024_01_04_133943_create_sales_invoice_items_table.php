<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_invoice_id')->nullable();
            $table->unsignedBigInteger('sales_order_id')->nullable();
            $table->string('sales_invoice_code')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->boolean('downpayment')->default(0)->nullable();
            $table->decimal('down_payment_total', 14, 2)->nullable();
            $table->decimal('payment', 14, 2)->nullable();
            $table->longText('reference')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('submited_by')->nullable();
            $table->date('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('canceled_at')->nullable();
            $table->decimal('outstanding', 14, 2)->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->foreign('submited_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sales_invoice_id')->references('id')->on('sales_invoices')->onDelete('cascade');
            $table->foreign('sales_order_id')->references('id')->on('salesorders')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
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
        Schema::dropIfExists('sales_invoice_items');
    }
}
