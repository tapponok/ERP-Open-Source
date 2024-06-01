<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwofieldsToPuchaseinviceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_invoice_items', function (Blueprint $table) {
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_invoice_items', function (Blueprint $table) {
            $table->dropColumn('product_code');
        });
    }
}
