<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChallengesTable extends Migration
{
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_10138610')->references('id')->on('challenge_categories');
            $table->unsignedBigInteger('difficulty_level_id')->nullable();
            $table->foreign('difficulty_level_id', 'difficulty_level_fk_10138736')->references('id')->on('difficulty_levels');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138035')->references('id')->on('users');
        });
    }
}
