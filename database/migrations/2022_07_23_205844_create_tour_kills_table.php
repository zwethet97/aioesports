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
        Schema::create('tour_kills', function (Blueprint $table) {
            $table->id();
            $table->string('tour_id');
            $table->string('1_player_logo');
            $table->string('1_player_name');
            $table->string('1_player_team');
            $table->string('1_player_point');
            $table->string('2_player_logo');
            $table->string('2_player_name');
            $table->string('2_player_team');
            $table->string('2_player_point');
            $table->string('3_player_logo');
            $table->string('3_player_name');
            $table->string('3_player_team');
            $table->string('3_player_point');
            $table->string('4_player_logo');
            $table->string('4_player_name');
            $table->string('4_player_team');
            $table->string('4_player_point');
            $table->string('5_player_logo');
            $table->string('5_player_name');
            $table->string('5_player_team');
            $table->string('5_player_point');
            $table->string('6_player_logo');
            $table->string('6_player_name');
            $table->string('6_player_team');
            $table->string('6_player_point');
            $table->string('7_player_logo');
            $table->string('7_player_name');
            $table->string('7_player_team');
            $table->string('7_player_point');
            $table->string('8_player_logo');
            $table->string('8_player_name');
            $table->string('8_player_team');
            $table->string('8_player_point');
            $table->string('9_player_logo');
            $table->string('9_player_name');
            $table->string('9_player_team');
            $table->string('9_player_point');
            $table->string('10_player_logo');
            $table->string('10_player_name');
            $table->string('10_player_team');
            $table->string('10_player_point');
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
        Schema::dropIfExists('tour_kills');
    }
};
