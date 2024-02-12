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
        Schema::create('file_vectors', function (Blueprint $table) {
            $table->id();
            $table->json('vector');
            $table->unsignedBigInteger('file_text_id');
            $table->unsignedBigInteger('course_id');

            $table->foreign('file_text_id')->references('id')->on('file_texts')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_vectors');
    }
};
