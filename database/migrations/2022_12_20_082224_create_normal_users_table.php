<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('normal_users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('phone_no');
            $table->string('dob');
            $table->string('profile_image');
            $table->integer('sheild');
            $table->integer('diamond');
            $table->string('city');
            $table->string('state');
            $table->string('gender');
            $table->string('otp',6);
            $table->integer('verified');
            $table->rememberToken();
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
        Schema::dropIfExists('normal_users');
    }
};
