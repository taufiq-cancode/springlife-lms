<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bsQuiz extends Model
{
    use HasFactory;

    public function bsLesson()
    {
        return $this->belongsTo(bsLesson::class);
    }

    public function bsQuestions()
    {
        return $this->hasMany(bsQuestion::class);
    }
}
