<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTeamsTable extends Migration
{
    public function up()
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('team_leader_id')->nullable();
            $table->foreign('team_leader_id', 'team_leader_fk_10138601')->references('id')->on('members');
            $table->unsignedBigInteger('challenge_id')->nullable();
            $table->foreign('challenge_id', 'challenge_fk_10138603')->references('id')->on('challenges');
            $table->unsignedBigInteger('actual_solution_id')->nullable();
            $table->foreign('actual_solution_id', 'actual_solution_fk_10138602')->references('id')->on('actual_solutions');
            $table->unsignedBigInteger('mentorship_needed_id')->nullable();
            $table->foreign('mentorship_needed_id', 'mentorship_needed_fk_10138604')->references('id')->on('mentorship_neededs');
            $table->unsignedBigInteger('participation_method_id')->nullable();
            $table->foreign('participation_method_id', 'participation_method_fk_10138605')->references('id')->on('participation_methods');
        });
    }
}
