<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEvaluationCriteriaTable extends Migration
{
    public function up()
    {
        Schema::table('evaluation_criteria', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138415')->references('id')->on('users');
        });
    }
}
