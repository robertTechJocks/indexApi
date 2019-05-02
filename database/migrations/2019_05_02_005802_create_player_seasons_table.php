<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id');
            $table->integer('wins')->default(0);
            $table->integer('losses')->default(0);
            $table->integer('overtime_losses')->default(0);
            $table->integer('goals')->default(0);
            $table->integer('assists')->default(0);
            $table->integer('points')->default(0);
            $table->integer('plus_minus')->default(0);
            $table->integer('pim')->default(0);
            $table->integer('shots')->default(0);
            $table->integer('hits')->default(0);
            $table->integer('shots_blocked')->default(0);
            $table->integer('give_aways')->default(0);
            $table->integer('take_aways')->default(0);
            $table->float('face_off_percent')->default(0);
            $table->string('minutes_played')->default("N/A");
            $table->string('power_play_minutes_played')->default("N/A");
            $table->string('penalty_kill_minutes_played')->default("N/A");
            $table->integer('power_play_goals')->default(0);
            $table->integer('power_play_assists')->default(0);
            $table->integer('penalty_kill_goals')->default(0);
            $table->integer('penalty_kill_assists')->default(0);
            $table->integer('game_winning_goals')->default(0);
            $table->integer('hat_tricks')->default(0);
            $table->float('shot_percentage')->default(0);
            $table->integer('goals_against')->default(0);
            $table->integer('shots_against')->default(0);
            $table->float('goals_against_average')->default(0);
            $table->float('save_percentage')->default(0);
            $table->integer('shutouts')->default(0);
            $table->integer('season_id');
            $table->integer('league_id');
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
        Schema::dropIfExists('player_seasons');
    }
}
