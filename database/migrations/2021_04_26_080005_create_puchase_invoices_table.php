<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('pi_number');
            $table->string('status');
            $table->decimal('total', 14, 2);
            $table->string('note')->nullable();
            $table->unsignedBigInteger('purchase_order_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('updated_at')->nullable()->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->date('approved_at')->nullable()->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('canceled_at')->nullable()->nullable();
            $table->unsignedBigInteger('canceled_by')->nullable();
            $table->boolean('isarchive')->default(0);
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('canceled_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puchase_invoices');
    }
}
