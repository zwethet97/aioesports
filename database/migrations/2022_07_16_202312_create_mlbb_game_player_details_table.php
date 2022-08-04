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
        Schema::create('mlbb_game_player_details', function (Blueprint $table) {
            $table->id();
            $table->string('mlbbgame_id');
            $table->string('gl1_player_id');
            $table->string('gl1_player_hero_n');
            $table->string('gl1_player_hero_img');
            $table->string('gl1_player_k');
            $table->string('gl1_player_d');
            $table->string('gl1_player_a');
            $table->string('gl1_player_gold');
            $table->string('gl1_player_lvl');
            $table->string('gl1_player_it');
            $table->string('gl1_player_it2');
            $table->string('gl1_player_it3');
            $table->string('gl1_player_it4');
            $table->string('gl1_player_it5');
            $table->string('gl1_player_it6');
            $table->string('gl1_player_sk');
            $table->string('gl2_player_id');
            $table->string('gl2_player_hero_n');
            $table->string('gl2_player_hero_img');
            $table->string('gl2_player_k');
            $table->string('gl2_player_d');
            $table->string('gl2_player_a');
            $table->string('gl2_player_gold');
            $table->string('gl2_player_lvl');
            $table->string('gl2_player_it');
            $table->string('gl2_player_it2');
            $table->string('gl2_player_it3');
            $table->string('gl2_player_it4');
            $table->string('gl2_player_it5');
            $table->string('gl2_player_it6');
            $table->string('gl2_player_sk');
            $table->string('el1_player_id');
            $table->string('el1_player_hero_n');
            $table->string('el1_player_hero_img');
            $table->string('el1_player_k');
            $table->string('el1_player_d');
            $table->string('el1_player_a');
            $table->string('el1_player_gold');
            $table->string('el1_player_lvl');
            $table->string('el1_player_it');
            $table->string('el1_player_it2');
            $table->string('el1_player_it3');
            $table->string('el1_player_it4');
            $table->string('el1_player_it5');
            $table->string('el1_player_it6');
            $table->string('el1_player_sk');
            $table->string('el2_player_id');
            $table->string('el2_player_hero_n');
            $table->string('el2_player_hero_img');
            $table->string('el2_player_k');
            $table->string('el2_player_d');
            $table->string('el2_player_a');
            $table->string('el2_player_gold');
            $table->string('el2_player_lvl');
            $table->string('el2_player_it');
            $table->string('el2_player_it2');
            $table->string('el2_player_it3');
            $table->string('el2_player_it4');
            $table->string('el2_player_it5');
            $table->string('el2_player_it6');
            $table->string('el2_player_sk');
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
        Schema::dropIfExists('mlbb_game_player_details');
    }
};
