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
        Schema::create('bs_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bs_lesson_id');
            $table->foreign('bs_lesson_id')->references('id')->on('bs_lessons')->onDelete('cascade');
            $table->string('question_text');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->enum('correct_option', ['option1', 'option2', 'option3', 'option4']);
            $table->text('explanation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_questions');
    }
};
