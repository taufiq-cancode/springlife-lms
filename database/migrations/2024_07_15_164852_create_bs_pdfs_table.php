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
        Schema::create('bs_pdfs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bs_lesson_id');
            $table->foreign('bs_lesson_id')->references('id')->on('bs_lessons')->onDelete('cascade');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_pdfs');
    }
};
