<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    public function index(){
        try{
            // $user = auth()->user();  
            // if(!$user){
            //     return redirect()->back()->with('error', 'Unauthorized access');
            // }

            // $courses = Course::all();

            // if (!$courses) {
            //     return redirect()->back()->with('error', 'Courses not found');
            // }
            
            return view('lessons.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving courses : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving lessons');
        }        
    }
}
