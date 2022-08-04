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
        Schema::create('dota_game_details', function (Blueprint $table) {
            $table->id();
            $table->string('matchdetail_id');
            $table->string('team1_id');
            $table->string('team2_id');
            $table->string('duration');
            $table->string('team1_score');
            $table->string('team2_score');
            $table->string('victory');
            $table->string('lose');
            $table->string('mvp_player_id');
            $table->string('mvp_player_hero_n');
            $table->string('mvp_player_hero_img');
            $table->string('mvp_player_k');
            $table->string('mvp_player_d');
            $table->string('mvp_player_a');
            $table->string('mvp_player_gold');
            $table->string('mvp_player_gpm');
            $table->string('mvp_player_xpm');
            $table->string('mvp_player_lhdn');
            $table->string('mvp_player_scep');
            $table->string('mvp_player_shard');
            $table->string('mvp_player_lvl');
            $table->string('mvp_player_it');
            $table->string('mvp_player_it2');
            $table->string('mvp_player_it3');
            $table->string('mvp_player_it4');
            $table->string('mvp_player_it5');
            $table->string('mvp_player_it6');
            $table->string('mvp_player_neu');
            $table->string('mvp_player_bp1');
            $table->string('mvp_player_bp2');
            $table->string('mvp_player_bp3');
            $table->string('team1_gold');
            $table->string('team2_gold');
            $table->string('team1_xpm');
            $table->string('team2_xpm');
            $table->string('team1_k');
            $table->string('team2_k');
            $table->string('team1_d');
            $table->string('team2_d');
            $table->string('team1_a');
            $table->string('team2_a');
            $table->string('team1_tw');
            $table->string('team2_tw');
            $table->string('team1_rs');
            $table->string('team2_rs');
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
        Schema::dropIfExists('dota_game_details');
    }
};
