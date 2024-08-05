<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChapterReport;
use App\Models\MissionReport;
use App\Models\RegionalReport;
use App\Models\StudentReport;
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

        $userCSR = $user>with('chapter');

        if ($userRole === 'chapter_coordinator') {
            $userReports = ChapterReport::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        } elseif ($userRole === 'national_coordinator') {
            $userReports = MissionReport::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get(); 
        } elseif ($userRole === 'zonal_coordinator') {
            $userReports = ZonalReport::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        } elseif ($userRole === 'regional_coordinator') {
            $userReports = RegionalReport::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        } elseif ($userRole === 'student_coordinator') {
            $userReports = StudentReport::where('user_id', $user->id)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        } else {
            $userReports = null;
        }

        if(auth()->user()->role === "chapter_coordinator"){
            $studentReports = StudentReport::where('chapter_name', auth()->user()->chapter->name)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        }else{
            $studentReports = StudentReport::all();
        }

        if (auth()->user()->role === 'zonal_coordinator') {
            $zoneId = auth()->user()->zone_id; // Get the zone_id of the logged-in zonal coordinator
            $chapterReports = ChapterReport::whereHas('user', function ($query) use ($zoneId) {
                $query->where('zone_id', $zoneId);
            })->orderBy('created_at', 'desc')->get();
        } else {
            $chapterReports = ChapterReport::all();
        }
        

        $chapterReports = ChapterReport::all();
        $zonalReports = ZonalReport::all();
        $regionalReports = RegionalReport::all();
        $missionReports = MissionReport::all();

        return view('reports.index', compact('userReports', 'studentReports', 'chapterReports', 'zonalReports', 'regionalReports', 'missionReports'));
    }
    
    public function create()
    {
        return view('reports.create');
    }

    public function showReport($id, $role)
    {  
        if ($role === 'chapter_coordinator') {
            $data = ChapterReport::where('id', $id)->first(); 
        } else if ($role === 'regional_coordinator') {
            $data = RegionalReport::where('id', $id)->first(); 
        } else if ($role === 'zonal_coordinator') {
            $data = ZonalReport::where('id', $id)->first();
        } else if ($role === 'student_coordinator') {
            $data = StudentReport::where('id', $id)->first(); 
        } else if ($role === 'mission_coordinator') {
            $data = MissionReport::where('id', $id)->first(); 
        }
                
        return view('reports.view', ['report' => $data, 'role' => $role]);
    }

    public function student(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'zone_or_conference_name' => 'required|string|max:255',
                'year_level' => 'required|string|in:100 level,200 level,300 level,400 level',
                'phone_number' => 'required|string|max:15',
                'mission_training_completed' => 'required|boolean',
                'mission_training_completed_date' => 'nullable|date|required_if:mission_training_completed,1',
                'bible_study_completed' => 'required|boolean',
                'bible_study_completed_date' => 'nullable|date|required_if:christ_our_saviour_bible_study_completed,1',
            ]);

            $validatedData['chapter_name'] = auth()->user()->chapter->name;
            $validatedData['full_name'] = auth()->user()->firstname .' '.auth()->user()->lastname;
            $validatedData['email'] = auth()->user()->email;
            $validatedData['user_id'] = auth()->user()->id;

            StudentReport::create($validatedData);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');       
        
        }catch (ValidationException $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('Error', $e->getMessage());       
        } 
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
        try {
            Log::info('Request received.');

            $validatedData = $request->validate([
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
                'any_photograph_taken_during_the_mission_event.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            Log::info('Validation successful.', $validatedData);

            $imagePaths = [];

            if ($request->hasfile('any_photograph_taken_during_the_mission_event')) {
                Log::info('Files detected.');

                foreach ($request->file('any_photograph_taken_during_the_mission_event') as $image) {
                    $imagePath = $image->store('mission_images', 'public');
                    $imagePaths[] = $imagePath;

                    Log::info('Image stored.', ['path' => $imagePath]);
                }

                $validatedData['any_photograph_taken_during_the_mission_event'] = json_encode($imagePaths);
                Log::info('Image paths JSON encoded.', ['paths' => $imagePaths]);
            } else {
                Log::info('No files uploaded.');
            }

            $userId = Auth::id();
            $validatedData['user_id'] = $userId;
            $validatedData['name_of_your_zone'] = auth()->user()->zone->name;
            Log::info('User ID attached.', ['user_id' => $userId]);

            ZonalReport::create($validatedData);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
        } catch (ValidationException $e) {
            Log::error('Validation failed.', ['error' => $e->errors()]);

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred.', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', $e->getMessage());
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
                'any_photograph_taken_during_the_mission_event.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            $imagePaths = [];

            if ($request->hasfile('any_photograph_taken_during_the_mission_event')) {
                Log::info('Files detected.');

                foreach ($request->file('any_photograph_taken_during_the_mission_event') as $image) {
                    $imagePath = $image->store('mission_images', 'public');
                    $imagePaths[] = $imagePath;

                    Log::info('Image stored.', ['path' => $imagePath]);
                }

                $validatedData['any_photograph_taken_during_the_mission_event'] = json_encode($imagePaths);
                Log::info('Image paths JSON encoded.', ['paths' => $imagePaths]);
            } else {
                Log::info('No files uploaded.');
            }

            $userId = Auth::id();
            $validatedData['user_id'] = $userId;
            Log::info('User ID attached.', ['user_id' => $userId]);

            RegionalReport::create($validatedData);
            Log::info('RegionalReport created.', $validatedData);

            return redirect()->route('reports.index')->with('success', 'Report submitted successfully.');
        } catch (ValidationException $e) {
            Log::error('Validation failed.', ['error' => $e->errors()]);

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('An unexpected error occurred.', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
