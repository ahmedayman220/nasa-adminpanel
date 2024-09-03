<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('bootcamp_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('email')->unique();
            $table->string('age');
            $table->string('phone_number');
            $table->string('educational_institute');
            $table->string('graduation_year');
            $table->string('position');
            $table->string('national')->unique();
            $table->string('is_participated');
            $table->string('participated_year')->nullable();
            $table->string('is_attend_formation_activity');
            $table->string('why_this_workshop');
            $table->string('is_have_team');
            $table->string('comment')->nullable();
            $table->string('year');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
