<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'chapter_name',
        'zone_or_conference_name',
        'year_level',
        'phone_number',
        'mission_training_completed',
        'mission_training_completed_date',
        'bible_study_completed',
        'bible_study_completed_date',
        'email',
        'username',
    ];

    protected $casts = [
        'mission_training_completed' => 'boolean',
        'bible_study_completed' => 'boolean',
    ];
}
