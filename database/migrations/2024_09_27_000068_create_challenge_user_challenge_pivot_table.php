<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengeUserChallengePivotTable extends Migration
{
    public function up()
    {
        Schema::create('challenge_user_challenge', function (Blueprint $table) {
            $table->unsignedBigInteger('user_challenge_id');
            $table->foreign('user_challenge_id', 'user_challenge_id_fk_10150845')->references('id')->on('user_challenges')->onDelete('cascade');
            $table->unsignedBigInteger('challenge_id');
            $table->foreign('challenge_id', 'challenge_id_fk_10150845')->references('id')->on('challenges')->onDelete('cascade');
        });
    }
}
