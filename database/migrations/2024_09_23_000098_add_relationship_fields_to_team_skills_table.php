<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeamSkillsTable extends Migration
{
    public function up()
    {
        Schema::table('team_skills', function (Blueprint $table) {
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->foreign('skill_id', 'skill_fk_10138738')->references('id')->on('skills');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138315')->references('id')->on('users');
        });
    }
}
