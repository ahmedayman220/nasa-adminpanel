<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampConfirmationsTable extends Migration
{
    public function up()
    {
        Schema::create('bootcamp_confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
