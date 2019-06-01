<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStrengthsWeaknessesToPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string("strength_1")->nullable();
            $table->string("strength_2")->nullable();
            $table->string("strength_3")->nullable();
            $table->string("weakness")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn("strength_1");
            $table->dropColumn("strength_2");
            $table->dropColumn("strength_3");
            $table->dropColumn("weakness");
        });
    }
}
