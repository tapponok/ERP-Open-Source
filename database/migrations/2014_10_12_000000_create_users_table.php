<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('profile_photo_path')->nullable();
            $table->unsignedBigInteger('garage_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('isarchive')->default(0);
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
