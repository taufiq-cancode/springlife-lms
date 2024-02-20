<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'option1', 'option2', 'option3', 'option4', 'correct_option', 'course_id'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
