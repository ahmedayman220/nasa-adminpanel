<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToQrCodesTable extends Migration
{
    public function up()
    {
        Schema::table('qr_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('bootcamp_participant_id')->nullable();
            $table->foreign('bootcamp_participant_id', 'bootcamp_participant_fk_10070668')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070674')->references('id')->on('users');
        });
    }
}
