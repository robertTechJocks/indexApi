<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('home_team_id');
            $table->integer('away_team_id');
            $table->integer('first_home_goals')->default(0);
            $table->integer('second_home_goals')->default(0);
            $table->integer('third_home_goals')->default(0);
            $table->integer('first_away_goals')->default(0);
            $table->integer('second_away_goals')->default(0);
            $table->integer('third_away_goals')->default(0);
            $table->string('first_home_goals_info')->default("N/A");
            $table->string('second_home_goals_info')->default("N/A");
            $table->string('third_home_goals_info')->default("N/A");
            $table->string('first_away_goals_info')->default("N/A");
            $table->string('second_away_goals_info')->default("N/A");
            $table->string('third_away_goals_info')->default("N/A");
            $table->integer('first_home_shots')->default(0);
            $table->integer('second_home_shots')->default(0);
            $table->integer('third_home_shots')->default(0);
            $table->integer('first_away_shots')->default(0);
            $table->integer('second_away_shots')->default(0);
            $table->integer('third_away_shots')->default(0);
            $table->string('first_home_penalties')->default("N/A");
            $table->string('second_home_penalties')->default("N/A");
            $table->string('third_home_penalties')->default("N/A");
            $table->string('first_away_penalties')->default("N/A");
            $table->string('second_away_penalties')->default("N/A");
            $table->string('third_away_penalties')->default("N/A");
            $table->string('player_stats_home')->default("N/A");
            $table->string('player_stats_away')->default("N/A");
            $table->string('goalie_stats')->default("N/A");
            $table->integer('leagues_id');
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
        Schema::dropIfExists('games');
    }
}
