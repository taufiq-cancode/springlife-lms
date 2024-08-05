<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function reports()
    {
        return $this->hasMany(ChapterReport::class);
    }

    public function coordinators()
    {
        return $this->hasMany(User::class)->where('role', 'chapter_coordinator');
    }
}
