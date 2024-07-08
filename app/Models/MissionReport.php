<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_of_your_institution',
        'date_of_the_report',
        'name_of_your_witnessing_partner',
        'number_of_contacts_this_month',
        'number_of_bible_studies_given',
        'total_hours_put_into_mission_this_month',
        'number_of_literatures_given',
        'number_of_interest_in_bible_study_given',
        'any_challenge_encounter_on_mission_field',
        'any_mission_related_testimony_or_story',
    ];
}
