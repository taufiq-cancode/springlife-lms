<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bsStudentProgress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bs_lesson_id', 'is_completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bsLesson()
    {
        return $this->belongsTo(bsLesson::class);
    }
}
