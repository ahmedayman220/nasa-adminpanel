<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bootcamp_confirmations', function (Blueprint $table) {
            $table->unsignedBigInteger('email_id')->nullable();
            $table->foreign('email_id', 'email_fk_10120133')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('national_id')->nullable();
            $table->foreign('national_id', 'national_fk_10120134')->references('id')->on('bootcamp_participants');
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->foreign('slot_id', 'slot_fk_10120136')->references('id')->on('study_levels');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_10120140')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bootcamp_confirmations', function (Blueprint $table) {
            //
        });
    }
};
