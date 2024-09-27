<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMemberCheckpointsTable extends Migration
{
    public function up()
    {
        Schema::table('member_checkpoints', function (Blueprint $table) {
            $table->unsignedBigInteger('member_id')->nullable();
            $table->foreign('member_id', 'member_fk_10139150')->references('id')->on('members');
            $table->unsignedBigInteger('checkpoint_id')->nullable();
            $table->foreign('checkpoint_id', 'checkpoint_fk_10139151')->references('id')->on('checkpoints');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138347')->references('id')->on('users');
        });
    }
}
