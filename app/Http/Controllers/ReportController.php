<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChapterReport;
use App\Models\MissionReport;
use App\Models\RegionalReport;
use App\Models\Report;
use App\Models\ZonalReport;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userRole = $user->role;

        if ($userRole === 'chapter_coordinator') {
            $userReports = ChapterReport::where('user_id', $user->id)->get(); 
        } else if ($userRole === 'national_coordinator') {
            $userReports = MissionReport::where('user_id', $user->id)->get(); 
            $regionalReports = RegionalReport::all();
        } else if ($userRole === 'zonal_coordinator') {
            $userReports = ZonalReport::where('user_id', $user->id)->get(); 
            $chapterReports = ChapterReport::all();
        } else if ($userRole === 'regional_coordinator') {
            $userReports = RegionalReport::where('user_id', $user->id)->get(); 
            $zonalReports = ZonalReport::all();
        } 

        $chapterReports = ChapterReport::all();
        $zonalReports = ZonalReport::all();
        $regionalReports = RegionalReport::all();
        $missionReports = MissionReport::all();
        return view('reports.index', compact('userReports', 'chapterReports', 'zonalReports', 'regionalReports', 'missionReports'));
    }
    
    public function create()
    {
        return view('reports.create');
    }

    public function mission(Request $request)
    {
        try{
            $request->validate([
                'name_of_your_institution' => 'required|string|max:255',
                'date_of_the_report' => 'required|date',
                'name_of_your_witnessing_partner' => 'nullable|string|max:255',
                'number_of_contacts_this_month' => 'nullable|integer',
                'number_of_bible_studies_given' => 'nullable|integer',
                'total_hours_put_into_mission_this_month' => 'nullable|integer',
                'number_of_literatures_given' => 'nullable|integer',
                'number_of_interest_in_bible_study_given' => 'nullable|integer',
                'any_challenge_encounter_on_mission_field' => 'nullable|string',
                'any_mission_related_testimony_or_story' => 'nullable|string',
            ]);

            $userId = Auth::id();

            $data = $request->all();
            $data['user_id'] = $userId;

            MissionReport::create($data);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully!');
        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('Error', $e->getMessage());       
        } 
    }

    public function chapter(Request $request)
    {
        try{
            $request->validate([
                'name_of_your_institution' => 'required|string|max:255',
                'date_of_the_report' => 'required|date',
                'number_of_students_in_your_chapter' => 'nullable|integer',
                'number_of_missionaries_in_your_chapter' => 'nullable|integer',
                'name_of_active_missionaries_this_month' => 'nullable|string|max:255',
                'number_of_contacts_this_month' => 'nullable|integer',
                'number_of_bible_studies_given' => 'nullable|integer',
                'total_hours_put_into_mission_this_month' => 'nullable|integer',
                'number_of_literatures_given' => 'nullable|integer',
                'number_of_the_missionary_of_the_month' => 'nullable|integer',
                'did_your_chapter_embark_on_mission_related_program_this_month' => 'nullable|string',
                'if_yes_give_detail_in_this_box_below' => 'nullable|string',
                'mission_program' => 'nullable|string',
                'date1' => 'nullable|date',
                'program1' => 'nullable|string|max:255',
                'date2' => 'nullable|date',
                'program2' => 'nullable|string|max:255',
                'date3' => 'nullable|date',
                'program3' => 'nullable|string|max:255',
                'is_your_chapter_facing_any_challenge_in_the_mission_field' => 'nullable|string',
            ]);

            $userId = Auth::id();

            $data = $request->all();
            $data['user_id'] = $userId;

            ChapterReport::create($data);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully!');

        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('Error', $e->getMessage());       
        } 

    }

    public function zonal(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name_of_your_zone' => 'required|string|max:255',
                'date_of_the_report' => 'required|date',
                'number_of_chapters_in_your_zone' => 'nullable|integer',
                'number_of_missional_chapters_in_your_zone' => 'nullable|integer',
                'number_of_active_missional_chapters_this_month' => 'nullable|integer',
                'number_of_contacts_made_this_month' => 'nullable|string|max:255',
                'number_of_bible_studies_given' => 'nullable|integer',
                'total_hours_put_into_mission_this_month' => 'nullable|integer',
                'number_of_literatures_given' => 'nullable|integer',
                'name_of_the_missionary_of_the_month' => 'nullable|string|max:255',
                'did_any_chapter_embark_on_mission_related_program_this_month' => 'nullable|string|max:255',
                'if_yes_give_detail_in_this_box_below' => 'nullable|string',
                'any_photograph_taken_during_the_mission_event' => 'nullable|file|mimes:jpg,jpeg,png',
                'mission_follow_up_plan' => 'nullable|string',
                'mission_program' => 'nullable|string|max:255',
                'date1' => 'nullable|date',
                'program1' => 'nullable|string|max:255',
                'date2' => 'nullable|date',
                'program2' => 'nullable|string|max:255',
                'date3' => 'nullable|date',
                'program3' => 'nullable|string|max:255',
                'is_any_chapter_facing_any_challenge_in_the_mission_field' => 'nullable|string'
            ]);

            if ($request->hasFile('any_photograph_taken_during_the_mission_event')) {
                $path = $request->file('any_photograph_taken_during_the_mission_event')->store('uploads', 'public');
                $validatedData['any_photograph_taken_during_the_mission_event'] = $path;
            }

            $userId = Auth::id();
            $validatedData['user_id'] = $userId;

            ZonalReport::create($validatedData);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');

        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('Error', $e->getMessage());       
        } 
    }

    public function regional(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name_of_your_region' => 'required|string|max:255',
                'date_of_the_report' => 'required|date',
                'number_of_zones_in_your_region' => 'nullable|integer',
                'number_of_missional_zones_in_your_region' => 'nullable|integer',
                'number_of_active_missional_zones_this_month' => 'nullable|integer',
                'number_of_contacts_made_this_month' => 'nullable|string|max:255',
                'number_of_bible_studies_given' => 'nullable|integer',
                'total_hours_put_into_mission_this_month' => 'nullable|integer',
                'number_of_literatures_given' => 'nullable|integer',
                'name_of_the_missionary_of_the_month' => 'nullable|string|max:255',
                'did_any_zone_embark_on_mission_related_program_this_month' => 'nullable|string|max:255',
                'if_yes_give_detail_in_this_box_below' => 'nullable|string',
                'any_photograph_taken_during_the_mission_event' => 'nullable|file|mimes:jpg,jpeg,png',
                'mission_follow_up_plan' => 'nullable|string',
                'mission_program' => 'nullable|string|max:255',
                'date1' => 'nullable|date',
                'program1' => 'nullable|string|max:255',
                'date2' => 'nullable|date',
                'program2' => 'nullable|string|max:255',
                'date3' => 'nullable|date',
                'program3' => 'nullable|string|max:255',
                'is_any_chapter_facing_any_challenge_in_the_mission_field' => 'nullable|string'
            ]);

            if ($request->hasFile('any_photograph_taken_during_the_mission_event')) {
                $path = $request->file('any_photograph_taken_during_the_mission_event')->store('uploads', 'public');
                $validatedData['any_photograph_taken_during_the_mission_event'] = $path;
            }

            $userId = Auth::id();
            $validatedData['user_id'] = $userId;

            RegionalReport::create($validatedData);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');       
        
        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('Error', $e->getMessage());       
        } 
    }
}
