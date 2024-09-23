<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('workshop_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('schedule_time');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
