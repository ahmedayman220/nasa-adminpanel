<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToParticipantWorkshopAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::table('participant_workshop_assignments', function (Blueprint $table) {
            $table->unsignedBigInteger('bootcamp_participant_id')->nullable();
            $table->foreign('bootcamp_participant_id', 'bootcamp_participant_fk_10061817')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('workshop_schedule_id')->nullable();
            $table->foreign('workshop_schedule_id', 'workshop_schedule_fk_10061818')->references('id')->on('workshop_schedules');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10069333')->references('id')->on('users');
        });
    }
}
