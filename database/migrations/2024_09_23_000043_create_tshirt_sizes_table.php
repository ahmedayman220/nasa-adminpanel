<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTshirtSizesTable extends Migration
{
    public function up()
    {
        Schema::create('tshirt_sizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('extra_field')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
