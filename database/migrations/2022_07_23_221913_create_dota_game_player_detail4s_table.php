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
        Schema::create('dota_game_player_detail4s', function (Blueprint $table) {
            $table->id();
            $table->string('dotagame_id');
            $table->string('ss1_player_id');
            $table->string('ss1_player_hero_n');
            $table->string('ss1_player_hero_img');
            $table->string('ss1_player_k');
            $table->string('ss1_player_d');
            $table->string('ss1_player_a');
            $table->string('ss1_player_gold');
            $table->string('ss1_player_gpm');
            $table->string('ss1_player_xpm');
            $table->string('ss1_player_lhdn');
            $table->string('ss1_player_scep');
            $table->string('ss1_player_shard');
            $table->string('ss1_player_lvl');
            $table->string('ss1_player_it1');
            $table->string('ss1_player_it2');
            $table->string('ss1_player_it3');
            $table->string('ss1_player_it4');
            $table->string('ss1_player_it5');
            $table->string('ss1_player_it6');
            $table->string('ss1_player_neu');
            $table->string('ss1_player_bp1');
            $table->string('ss1_player_bp2');
            $table->string('ss1_player_bp3');
            $table->string('ss2_player_id');
            $table->string('ss2_player_hero_n');
            $table->string('ss2_player_hero_img');
            $table->string('ss2_player_k');
            $table->string('ss2_player_d');
            $table->string('ss2_player_a');
            $table->string('ss2_player_gold');
            $table->string('ss2_player_gpm');
            $table->string('ss2_player_xpm');
            $table->string('ss2_player_lhdn');
            $table->string('ss2_player_scep');
            $table->string('ss2_player_shard');
            $table->string('ss2_player_lvl');
            $table->string('ss2_player_it1');
            $table->string('ss2_player_it2');
            $table->string('ss2_player_it3');
            $table->string('ss2_player_it4');
            $table->string('ss2_player_it5');
            $table->string('ss2_player_it6');
            $table->string('ss2_player_neu');
            $table->string('ss2_player_bp1');
            $table->string('ss2_player_bp2');
            $table->string('ss2_player_bp3');
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
        Schema::dropIfExists('dota_game_player_detail4s');
    }
};
