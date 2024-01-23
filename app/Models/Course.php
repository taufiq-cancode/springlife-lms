<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'cover_image'];
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
