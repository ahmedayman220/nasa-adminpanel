<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('judge_id')->nullable();
            $table->foreign('judge_id', 'judge_fk_10138706')->references('id')->on('judges');
            $table->unsignedBigInteger('criteria_id')->nullable();
            $table->foreign('criteria_id', 'criteria_fk_10138723')->references('id')->on('evaluation_criteria');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138409')->references('id')->on('users');
        });
    }
}
