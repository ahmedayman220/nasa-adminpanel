<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamSkillsTable extends Migration
{
    public function up()
    {
        Schema::create('team_skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('proficiency_level', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
