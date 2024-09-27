<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMembersTable extends Migration
{
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('major_id')->nullable();
            $table->foreign('major_id', 'major_fk_10138561')->references('id')->on('majors');
            $table->unsignedBigInteger('study_level_id')->nullable();
            $table->foreign('study_level_id', 'study_level_fk_10138564')->references('id')->on('study_levelsses');
            $table->unsignedBigInteger('tshirt_size_id')->nullable();
            $table->foreign('tshirt_size_id', 'tshirt_size_fk_10138565')->references('id')->on('tshirt_sizes');
            $table->unsignedBigInteger('qr_code_id')->nullable();
            $table->foreign('qr_code_id', 'qr_code_fk_10138566')->references('id')->on('qr_codes');
            $table->unsignedBigInteger('transportation_id')->nullable();
            $table->foreign('transportation_id', 'transportation_fk_10138589')->references('id')->on('transportations');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10138341')->references('id')->on('users');
        });
    }
}
