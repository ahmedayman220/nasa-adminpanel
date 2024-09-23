<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkshopSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('workshop_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('workshop_id')->nullable();
            $table->foreign('workshop_id', 'workshop_fk_10061752')->references('id')->on('workshops');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070237')->references('id')->on('users');
        });
    }
}
