<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserChallengePivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_user_challenge', function (Blueprint $table) {
            $table->unsignedBigInteger('user_challenge_id');
            $table->foreign('user_challenge_id', 'user_challenge_id_fk_10150844')->references('id')->on('user_challenges')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_10150844')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
