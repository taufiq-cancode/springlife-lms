<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ChapterReport;
use App\Models\MissionReport;
use App\Models\RegionalReport;
use App\Models\StudentReport;
use App\Models\ZonalReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\Lesson;


class DashboardController extends Controller
{
    public function index(){
        try {
            $user = auth()->user();

            $courses = [];

            if ($user->role === 'admin') {
                $courses = Course::orderBy('created_at', 'desc')->get();
            } elseif ($user->role === 'tutor') {
                $courses = $user->tutoredCourses()->orderBy('created_at', 'desc')->get();
            } else {
                $courses = Course::orderBy('created_at', 'desc')->get();
            }
            
            $totalLessons = Lesson::count();
            $totalCourses = $courses->count();
            $reports = Report::all();
    
            $user = Auth::user();
            $completedLessons = $user->lessons()->wherePivot('completed', true)->count();
            
            return view('dashboard', compact('courses', 'totalLessons', 'completedLessons', 'totalCourses', 'reports'));
        } catch (\Exception $e) {
            Log::error('Error while accessing dashboard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error accessing dashboard');
        }        
    }

    public function campusDashboard(){
        try {
            $user = auth()->user();
            $userRole = $user->role;

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

            $chapterReports = ChapterReport::all();
            $studentReports = StudentReport::all();
            $zonalReports = ZonalReport::all();
            $regionalReports = RegionalReport::all();
            $missionReports = MissionReport::all();

            $coordinators = User::whereIn('role', [
                'student_coordinator',
                'chapter_coordinator',
                'zonal_coordinator',
                'regional_coordinator',
                'national_coordinator'
            ])->get();

            $studentCoordinators = User::where('role', 'student_coordinator')->get();
            $chapterCoordinators = User::where('role', 'chapter_coordinator')->get();
            $zonalCoordinators = User::where('role', 'zonal_coordinator')->get();
            $regionalCoordinators = User::where('role', 'regional_coordinator')->get();
            $nationalCoordinators = User::where('role', 'national_coordinator')->get();

            if(auth()->user()->role === 'admin'){
                return view('campus-dashboard', compact(
                    'userReports',
                    'studentReports',
                    'chapterReports',
                    'zonalReports',
                    'regionalReports',
                    'missionReports',
                    'coordinators',
                    'studentCoordinators',
                    'chapterCoordinators',
                    'zonalCoordinators',
                    'regionalCoordinators',
                    'nationalCoordinators'
                ));
            }else{
                return view('campus-dashboard', compact(
                    'userReports',
                    'studentReports',
                    'chapterReports',
                    'zonalReports',
                    'regionalReports',
                    'missionReports',
                ));
            }

        } catch (\Exception $e) {
            Log::error('Error while accessing dashboard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error accessing dashboard');
        }        
    }
    
}
