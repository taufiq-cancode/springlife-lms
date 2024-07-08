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
        Schema::create('mission_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_of_your_institution');
            $table->date('date_of_the_report');
            $table->string('name_of_your_witnessing_partner')->nullable();
            $table->integer('number_of_contacts_this_month')->nullable();
            $table->integer('number_of_bible_studies_given')->nullable();
            $table->integer('total_hours_put_into_mission_this_month')->nullable();
            $table->integer('number_of_literatures_given')->nullable();
            $table->integer('number_of_interest_in_bible_study_given')->nullable();
            $table->text('any_challenge_encounter_on_mission_field')->nullable();
            $table->text('any_mission_related_testimony_or_story')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_reports');
    }
};
