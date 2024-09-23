<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHackathonQrCodesTable extends Migration
{
    public function up()
    {
        Schema::table('hackathon_qr_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138353')->references('id')->on('users');
        });
    }
}
