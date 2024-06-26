<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
                $courses = Course::all();
            } elseif ($user->role === 'tutor') {
                $courses = $user->tutoredCourses;
            } else {
                $courses = Course::all();
            }
            $totalLessons = Lesson::count();
            $totalCourses = $courses->count();
    
            $user = Auth::user();
            $completedLessons = $user->lessons()->wherePivot('completed', true)->count();
            
            return view('dashboard', compact('courses', 'totalLessons', 'completedLessons', 'totalCourses'));
        } catch (\Exception $e) {
            Log::error('Error while accessing dashboard: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error accessing dashboard');
        }        
    }
    
}
