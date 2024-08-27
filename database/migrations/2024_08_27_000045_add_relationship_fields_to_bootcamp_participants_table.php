<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBootcampParticipantsTable extends Migration
{
    public function up()
    {
        Schema::table('bootcamp_participants', function (Blueprint $table) {
            $table->unsignedBigInteger('educational_level_id')->nullable();
            $table->foreign('educational_level_id', 'educational_level_fk_10063337')->references('id')->on('education_levels');
            $table->unsignedBigInteger('field_of_study_id')->nullable();
            $table->foreign('field_of_study_id', 'field_of_study_fk_10063338')->references('id')->on('mention_your_fields');
            $table->unsignedBigInteger('first_priority_id')->nullable();
            $table->foreign('first_priority_id', 'first_priority_fk_10065623')->references('id')->on('workshops');
            $table->unsignedBigInteger('second_priority_id')->nullable();
            $table->foreign('second_priority_id', 'second_priority_fk_10065624')->references('id')->on('workshops');
            $table->unsignedBigInteger('third_priority_id')->nullable();
            $table->foreign('third_priority_id', 'third_priority_fk_10065625')->references('id')->on('workshops');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10069356')->references('id')->on('users');
        });
    }
}
