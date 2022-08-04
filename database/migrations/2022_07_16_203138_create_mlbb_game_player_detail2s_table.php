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
        Schema::create('mlbb_game_player_detail2s', function (Blueprint $table) {
            $table->id();
            $table->string('mlbbgame_id');
            $table->string('jl1_player_id');
            $table->string('jl1_player_hero_n');
            $table->string('jl1_player_hero_img');
            $table->string('jl1_player_k');
            $table->string('jl1_player_d');
            $table->string('jl1_player_a');
            $table->string('jl1_player_gold');
            $table->string('jl1_player_lvl');
            $table->string('jl1_player_it');
            $table->string('jl1_player_it2');
            $table->string('jl1_player_it3');
            $table->string('jl1_player_it4');
            $table->string('jl1_player_it5');
            $table->string('jl1_player_it6');
            $table->string('jl1_player_sk');
            $table->string('jl2_player_id');
            $table->string('jl2_player_hero_n');
            $table->string('jl2_player_hero_img');
            $table->string('jl2_player_k');
            $table->string('jl2_player_d');
            $table->string('jl2_player_a');
            $table->string('jl2_player_gold');
            $table->string('jl2_player_lvl');
            $table->string('jl2_player_it');
            $table->string('jl2_player_it2');
            $table->string('jl2_player_it3');
            $table->string('jl2_player_it4');
            $table->string('jl2_player_it5');
            $table->string('jl2_player_it6');
            $table->string('jl2_player_sk');
            $table->string('r1_player_id');
            $table->string('r1_player_hero_n');
            $table->string('r1_player_hero_img');
            $table->string('r1_player_k');
            $table->string('r1_player_d');
            $table->string('r1_player_a');
            $table->string('r1_player_gold');
            $table->string('r1_player_lvl');
            $table->string('r1_player_it');
            $table->string('r1_player_it2');
            $table->string('r1_player_it3');
            $table->string('r1_player_it4');
            $table->string('r1_player_it5');
            $table->string('r1_player_it6');
            $table->string('r1_player_sk');
            $table->string('r2_player_id');
            $table->string('r2_player_hero_n');
            $table->string('r2_player_hero_img');
            $table->string('r2_player_k');
            $table->string('r2_player_d');
            $table->string('r2_player_a');
            $table->string('r2_player_gold');
            $table->string('r2_player_lvl');
            $table->string('r2_player_it');
            $table->string('r2_player_it2');
            $table->string('r2_player_it3');
            $table->string('r2_player_it4');
            $table->string('r2_player_it5');
            $table->string('r2_player_it6');
            $table->string('r2_player_sk');
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
        Schema::dropIfExists('mlbb_game_player_detail2s');
    }
};
