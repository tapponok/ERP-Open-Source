<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_orders', function (Blueprint $table) {
            $table->id();
            $table->string('codereceived')->nullable();
            $table->unsignedBigInteger('purchaseorder_id')->nullable();
            $table->unsignedBigInteger('purchaseinvoice_id')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('received_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('cancelled_at')->nullable();
            $table->date('receivedate')->nullable();
            $table->string('licenseplate')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->foreign('purchaseorder_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('purchaseinvoice_id')->references('id')->on('puchase_invoices')->onDelete('cascade');
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('received_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('receive_orders');
    }
}
