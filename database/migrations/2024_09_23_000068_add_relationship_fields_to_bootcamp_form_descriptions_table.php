<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBootcampFormDescriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('bootcamp_form_descriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070246')->references('id')->on('users');
        });
    }
}
