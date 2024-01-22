<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'files', 'description', 'cover_image'];
    protected $cast = [
        'files' => 'array',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
