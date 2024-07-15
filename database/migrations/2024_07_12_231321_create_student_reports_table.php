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
        Schema::create('student_reports', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('chapter_name');
            $table->string('zone_or_conference_name');
            $table->enum('year_level', ['100 level', '200 level', '300 level', '400 level']);
            $table->string('phone_number');
            $table->boolean('mission_training_completed');
            $table->date('mission_training_completed_date')->nullable();
            $table->boolean('bible_study_completed');
            $table->date('bible_study_completed_date')->nullable();
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_reports');
    }
};
