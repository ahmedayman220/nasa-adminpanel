<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantWorkshopAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('participant_workshop_assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('attendance_status');
            $table->time('check_in_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
