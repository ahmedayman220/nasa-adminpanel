<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChatbotTraningDatasTable extends Migration
{
    public function up()
    {
        Schema::table('chatbot_traning_datas', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10070634')->references('id')->on('users');
        });
    }
}
