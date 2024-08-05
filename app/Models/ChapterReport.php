<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chapter_id',
        'name_of_your_institution',
        'date_of_the_report',
        'number_of_students_in_your_chapter',
        'number_of_missionaries_in_your_chapter',
        'name_of_active_missionaries_this_month',
        'number_of_contacts_this_month',
        'number_of_bible_studies_given',
        'total_hours_put_into_mission_this_month',
        'number_of_literatures_given',
        'number_of_the_missionary_of_the_month',
        'did_your_chapter_embark_on_mission_related_program_this_month',
        'if_yes_give_detail_in_this_box_below',
        'mission_program',
        'date1',
        'program1',
        'date2',
        'program2',
        'date3',
        'program3',
        'is_your_chapter_facing_any_challenge_in_the_mission_field',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
