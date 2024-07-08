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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('institution');
            $table->date('report_date');
            $table->string('witnessing_partner')->nullable();
            $table->integer('contacts')->default(0);
            $table->integer('bible_studies')->default(0);
            $table->integer('mission_hours')->default(0);
            $table->integer('literatures_given')->default(0);
            $table->integer('interests')->default(0);
            $table->text('challenges')->nullable();
            $table->text('testimonies')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
