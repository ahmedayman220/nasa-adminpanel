<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('descriptions')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
