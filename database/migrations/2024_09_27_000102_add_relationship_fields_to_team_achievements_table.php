<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeamAchievementsTable extends Migration
{
    public function up()
    {
        Schema::table('team_achievements', function (Blueprint $table) {
            $table->unsignedBigInteger('achievement_id')->nullable();
            $table->foreign('achievement_id', 'achievement_fk_10138741')->references('id')->on('achievements');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138321')->references('id')->on('users');
        });
    }
}
