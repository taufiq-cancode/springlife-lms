<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'role',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class)->withPivot('completed');
    }

    public function hasCompletedCourse($course)
    {
        if ($course->lessons->isEmpty()) {
            return false;
        }
    
        return $this->lessons()->where('course_id', $course->id)->count() == $course->lessons->count();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_tutors', 'tutor_id', 'course_id');
    }

    public function tutoredCourses() 
    {
        return $this->belongsToMany(Course::class, 'course_tutors', 'tutor_id', 'course_id');
    }

    public function progress()
    {
        return $this->hasMany(bsStudentProgress::class);
    }

    public function bsLesson()
    {
        return $this->belongsTo(bsLesson::class, 'bs_lesson_id');
    }
}
