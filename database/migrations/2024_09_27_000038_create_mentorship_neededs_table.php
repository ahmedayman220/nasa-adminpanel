<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorshipNeededsTable extends Migration
{
    public function up()
    {
        Schema::create('mentorship_neededs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('extra_field')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
