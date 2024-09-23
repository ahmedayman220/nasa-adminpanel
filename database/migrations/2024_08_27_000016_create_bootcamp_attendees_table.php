<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampAttendeesTable extends Migration
{
    public function up()
    {
        Schema::create('bootcamp_attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category')->nullable();
            $table->string('attendance_status');
            $table->datetime('check_in_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
