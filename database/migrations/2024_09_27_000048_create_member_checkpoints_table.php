<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCheckpointsTable extends Migration
{
    public function up()
    {
        Schema::create('member_checkpoints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('completed')->default(0)->nullable();
            $table->datetime('completion_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
