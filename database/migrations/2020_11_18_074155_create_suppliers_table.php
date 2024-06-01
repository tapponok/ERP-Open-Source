<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postalcode')->nullable();
            $table->text('photo_path')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name');
            $table->boolean('isarchive')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
