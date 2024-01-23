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
            
            return view('lessons.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving courses : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving lessons');
        }        
    }

    public function store(Request $request){

        try{
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'link' => 'required|string',
            ]);
    
            $courseId = $request->input('course_id');
            $course = Course::findOrFail($courseId);

            if (!$course) {
                return redirect()->back()->with('error', 'Course not found');
            }
    
            $lesson = new Lesson([
                'title' => $request->input('title'),
                'link' => $request->input('link'),
            ]);
    
            $lesson->course_id = $courseId;
            $lesson->save();
    
            return redirect()->back()->with('success', 'Lesson added successfully');

        }catch(\Exception $e){
            Log::error('Error while adding lesson: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding lesson');
        }

    }
}
