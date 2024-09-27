<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMentionYourFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('mention_your_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070248')->references('id')->on('users');
        });
    }
}
