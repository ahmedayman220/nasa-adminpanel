<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantWorkshopPreferencesTable extends Migration
{
    public function up()
    {
        Schema::create('participant_workshop_preferences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('preference_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
