<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileVector extends Model
{
    use HasFactory;

    protected $fillable = ['vector', 'file_text_id', 'course_id'];

}
