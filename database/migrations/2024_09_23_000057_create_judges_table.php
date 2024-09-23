<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJudgesTable extends Migration
{
    public function up()
    {
        Schema::create('judges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('expertise');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
