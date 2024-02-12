<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileText extends Model
{
    use HasFactory;

    protected $fillable = ['file_text', 'course_id'];

}
