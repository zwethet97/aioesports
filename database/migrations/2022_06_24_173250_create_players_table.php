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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('team_id');
            $table->string('talent');
            $table->string('name');
            $table->string('full_name');
            $table->string('birthday');
            $table->string('location');
            $table->string('bio');
            $table->string('game');
            $table->string('role');
            $table->string('player_image');
            $table->string('cover_image');
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
        Schema::dropIfExists('players');
    }
};
