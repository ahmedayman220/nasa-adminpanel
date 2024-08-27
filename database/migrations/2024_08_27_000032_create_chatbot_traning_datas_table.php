<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatbotTraningDatasTable extends Migration
{
    public function up()
    {
        Schema::create('chatbot_traning_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question');
            $table->longText('answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
