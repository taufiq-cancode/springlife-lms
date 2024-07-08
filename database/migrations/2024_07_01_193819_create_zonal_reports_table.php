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
        Schema::create('zonal_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name_of_your_zone');
            $table->date('date_of_the_report');
            $table->integer('number_of_chapters_in_your_zone')->nullable();
            $table->integer('number_of_missional_chapters_in_your_zone')->nullable();
            $table->integer('number_of_active_missional_chapters_this_month')->nullable();
            $table->string('number_of_contacts_made_this_month')->nullable();
            $table->integer('number_of_bible_studies_given')->nullable();
            $table->integer('total_hours_put_into_mission_this_month')->nullable();
            $table->integer('number_of_literatures_given')->nullable();
            $table->string('name_of_the_missionary_of_the_month')->nullable();
            $table->string('did_any_chapter_embark_on_mission_related_program_this_month')->nullable();
            $table->text('if_yes_give_detail_in_this_box_below')->nullable();
            $table->string('any_photograph_taken_during_the_mission_event')->nullable();
            $table->text('mission_follow_up_plan')->nullable();
            $table->string('mission_program')->nullable();
            $table->date('date1')->nullable();
            $table->string('program1')->nullable();
            $table->date('date2')->nullable();
            $table->string('program2')->nullable();
            $table->date('date3')->nullable();
            $table->string('program3')->nullable();
            $table->text('is_any_chapter_facing_any_challenge_in_the_mission_field')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zonal_reports');
    }
};
