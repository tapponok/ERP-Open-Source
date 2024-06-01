<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddtwofieldToReceiveorderitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receive_order_items', function (Blueprint $table) {
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receive_order_items', function (Blueprint $table) {
            $table->dropColumn('product_code');
            $table->dropColumn('product_name');
        });
    }
}
