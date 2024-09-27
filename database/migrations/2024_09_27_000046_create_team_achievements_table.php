<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamAchievementsTable extends Migration
{
    public function up()
    {
        Schema::create('team_achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('earned_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
