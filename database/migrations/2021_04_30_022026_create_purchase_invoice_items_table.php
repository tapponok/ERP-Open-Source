<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_invoice_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 14, 2);
            $table->decimal('subtotal', 14, 2);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->boolean('isarchive')->default(0);
            $table->timestamps();
            $table->foreign('purchase_invoice_id')->references('id')->on('puchase_invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_invoice_items');
    }
}
