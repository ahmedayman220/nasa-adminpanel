<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMentorshipNeededsTable extends Migration
{
    public function up()
    {
        Schema::table('mentorship_neededs', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138051')->references('id')->on('users');
        });
    }
}
