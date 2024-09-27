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
        Schema::table('teams', function (Blueprint $table) {
            $table->integer("relevancy")->after('team_rating')->default(0);
            $table->integer("impact")->after('relevancy')->default(0);
            $table->integer("creativity")->after('impact')->default(0);
            $table->integer("proposal")->after('creativity')->default(0);
            $table->integer("video")->after('proposal')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            //
        });
    }
};
