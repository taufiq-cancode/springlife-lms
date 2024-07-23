<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bsLesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'content', 'video_link', 'video_id', 'duration'];

    public function bsPdfs()
    {
        return $this->hasMany(bsPdf::class);
    }
}
