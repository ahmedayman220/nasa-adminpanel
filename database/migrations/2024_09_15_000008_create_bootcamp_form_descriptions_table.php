<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBootcampFormDescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('bootcamp_form_descriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section_1_title')->nullable();
            $table->longText('section_1_description')->nullable();
            $table->longText('national_id_front_description')->nullable();
            $table->longText('national_id_back_description')->nullable();
            $table->string('section_2_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
