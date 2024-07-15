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
        Schema::table('zonal_reports', function (Blueprint $table) {
            $table->text('any_photograph_taken_during_the_mission_event')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zonal_reports', function (Blueprint $table) {
            $table->string('any_photograph_taken_during_the_mission_event')->nullable()->change();
        });
    }
};
