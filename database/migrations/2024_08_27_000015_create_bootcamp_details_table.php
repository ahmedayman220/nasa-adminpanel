<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('bootcamp_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->datetime('date')->nullable();
            $table->integer('total_capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
