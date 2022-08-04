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
        Schema::create('dota_game_player_details', function (Blueprint $table) {
            $table->id();
            $table->string('dotagame_id');
            $table->string('sl1_player_id');
            $table->string('sl1_player_hero_n');
            $table->string('sl1_player_hero_img');
            $table->string('sl1_player_k');
            $table->string('sl1_player_d');
            $table->string('sl1_player_a');
            $table->string('sl1_player_gold');
            $table->string('sl1_player_gpm');
            $table->string('sl1_player_xpm');
            $table->string('sl1_player_lhdn');
            $table->string('sl1_player_scep');
            $table->string('sl1_player_shard');
            $table->string('sl1_player_lvl');
            $table->string('sl1_player_it1');
            $table->string('sl1_player_it2');
            $table->string('sl1_player_it3');
            $table->string('sl1_player_it4');
            $table->string('sl1_player_it5');
            $table->string('sl1_player_it6');
            $table->string('sl1_player_neu');
            $table->string('sl1_player_bp1');
            $table->string('sl1_player_bp2');
            $table->string('sl1_player_bp3');
            $table->string('sl2_player_id');
            $table->string('sl2_player_hero_n');
            $table->string('sl2_player_hero_img');
            $table->string('sl2_player_k');
            $table->string('sl2_player_d');
            $table->string('sl2_player_a');
            $table->string('sl2_player_gold');
            $table->string('sl2_player_gpm');
            $table->string('sl2_player_xpm');
            $table->string('sl2_player_lhdn');
            $table->string('sl2_player_scep');
            $table->string('sl2_player_shard');
            $table->string('sl2_player_lvl');
            $table->string('sl2_player_it1');
            $table->string('sl2_player_it2');
            $table->string('sl2_player_it3');
            $table->string('sl2_player_it4');
            $table->string('sl2_player_it5');
            $table->string('sl2_player_it6');
            $table->string('sl2_player_neu');
            $table->string('sl2_player_bp1');
            $table->string('sl2_player_bp2');
            $table->string('sl2_player_bp3');
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
        Schema::dropIfExists('dota_game_player_details');
    }
};
