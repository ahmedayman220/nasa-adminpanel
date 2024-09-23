<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCheckpointsTable extends Migration
{
    public function up()
    {
        Schema::table('checkpoints', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_10138725')->references('id')->on('events');
            $table->unsignedBigInteger('checkpoint_type_id')->nullable();
            $table->foreign('checkpoint_type_id', 'checkpoint_type_fk_10138726')->references('id')->on('checkpoint_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138397')->references('id')->on('users');
        });
    }
}
