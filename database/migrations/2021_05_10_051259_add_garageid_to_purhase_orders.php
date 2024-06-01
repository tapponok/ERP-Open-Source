<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGarageidToPurhaseOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->foreign('garage_id')->references('id')->on('garages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('garage_id');
        });
    }
}
