<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->string('team_name');
            $table->boolean('limited_capacity')->default(0);
            $table->boolean('members_participated_before')->default(0);
            $table->string('project_proposal_url')->unique();
            $table->string('project_video_url')->unique();
            $table->float('team_rating', 15, 2)->nullable();
            $table->float('total_score', 15, 2)->nullable();
            $table->string('status')->nullable();
            $table->datetime('submission_date')->nullable();
            $table->string('extra_field')->nullable();
            $table->string('comment');
            $table->longText('nots')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
