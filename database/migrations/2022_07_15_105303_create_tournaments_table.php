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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('game');
            $table->string('series');
            $table->string('tier');
            $table->string('name');
            $table->string('prize_pool');
            $table->string('organizer');
            $table->string('inc_teams');
            $table->string('location');
            $table->string('format');
            $table->string('type');
            $table->string('patch');
            $table->string('venues');
            $table->string('casters');
            $table->string('analysts');
            $table->string('commentators');
            $table->string('panelists');
            $table->string('quests');
            $table->string('tour_info');
            $table->string('format_info');
            $table->string('from_to');
            $table->string('start_date');
            $table->string('tour_image');
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
        Schema::dropIfExists('tournaments');
    }
};
