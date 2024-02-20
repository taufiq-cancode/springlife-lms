<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'cover_image', 'file'];
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Inside your Course model
    public function getUserProgress(User $user)
    {
        $totalLessons = $this->lessons->count();

        $completedLessons = $user->lessons()->where('lessons.course_id', $this->id)->wherePivot('completed', true)->count();

        if ($totalLessons > 0) {
            $progressPercentage = ($completedLessons / $totalLessons) * 100;
        } else {
            $progressPercentage = 0;
        }

        return [
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessons,
            'progressPercentage' => $progressPercentage,
        ];
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    




}
