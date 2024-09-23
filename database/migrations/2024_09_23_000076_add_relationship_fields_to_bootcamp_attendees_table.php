<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBootcampAttendeesTable extends Migration
{
    public function up()
    {
        Schema::table('bootcamp_attendees', function (Blueprint $table) {
            $table->unsignedBigInteger('bootcamp_details_id')->nullable();
            $table->foreign('bootcamp_details_id', 'bootcamp_details_fk_10061857')->references('id')->on('bootcamp_details');
            $table->unsignedBigInteger('bootcamp_participant_id')->nullable();
            $table->foreign('bootcamp_participant_id', 'bootcamp_participant_fk_10061858')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070129')->references('id')->on('users');
        });
    }
}
