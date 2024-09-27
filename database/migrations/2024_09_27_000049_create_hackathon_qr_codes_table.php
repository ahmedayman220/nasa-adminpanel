<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHackathonQrCodesTable extends Migration
{
    public function up()
    {
        Schema::create('hackathon_qr_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('test')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
