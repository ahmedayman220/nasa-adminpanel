<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToParticipantWorkshopPreferencesTable extends Migration
{
    public function up()
    {
        Schema::table('participant_workshop_preferences', function (Blueprint $table) {
            $table->unsignedBigInteger('bootcamp_participant_id')->nullable();
            $table->foreign('bootcamp_participant_id', 'bootcamp_participant_fk_10061825')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('workshop_id')->nullable();
            $table->foreign('workshop_id', 'workshop_fk_10061826')->references('id')->on('workshops');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10069473')->references('id')->on('users');
        });
    }
}
