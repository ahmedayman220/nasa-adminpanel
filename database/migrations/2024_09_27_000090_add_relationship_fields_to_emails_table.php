<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmailsTable extends Migration
{
    public function up()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->unsignedBigInteger('qrcode_id')->nullable();
            $table->foreign('qrcode_id', 'qrcode_fk_10070678')->references('id')->on('qr_codes');
            $table->unsignedBigInteger('bootcamp_participant_email_id')->nullable();
            $table->foreign('bootcamp_participant_email_id', 'bootcamp_participant_email_fk_10070680')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070684')->references('id')->on('users');
        });
    }
}
