<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationCriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('evaluation_criteria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('weight', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
