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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user', 'tutor', 'chapter_coordinator', 'zonal_coordinator', 'regional_coordinator', 'national_coordinator', 'student_coordinator'])->default('user')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user', 'tutor', 'chapter_coordinator', 'zonal_coordinator', 'regional_coordinator', 'national_coordinator'])->default('user')->change();
        });
    }
};
