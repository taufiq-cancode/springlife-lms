<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bsPdf extends Model
{
    use HasFactory;

    protected $fillable = ['bs_lesson_id', 'file_path'];

    public function bsLesson()
    {
        return $this->belongsTo(bsLesson::class);
    }
}
