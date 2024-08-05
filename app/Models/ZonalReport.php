<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'zone_id',
        'name_of_your_zone',
        'date_of_the_report',
        'number_of_chapters_in_your_zone',
        'number_of_missional_chapters_in_your_zone',
        'number_of_active_missional_chapters_this_month',
        'number_of_contacts_made_this_month',
        'number_of_bible_studies_given',
        'total_hours_put_into_mission_this_month',
        'number_of_literatures_given',
        'name_of_the_missionary_of_the_month',
        'did_any_chapter_embark_on_mission_related_program_this_month',
        'if_yes_give_detail_in_this_box_below',
        'any_photograph_taken_during_the_mission_event',
        'mission_follow_up_plan',
        'mission_program',
        'date1',
        'program1',
        'date2',
        'program2',
        'date3',
        'program3',
        'is_any_chapter_facing_any_challenge_in_the_mission_field'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
