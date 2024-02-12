<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    private function extractVideoId($url){

        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }

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
                'duration' => 'required|integer',
            ]);

            $videoId = $this->extractVideoId($request->input('link'));

    
            $courseId = $request->input('course_id');
            $course = Course::findOrFail($courseId);

            if (!$course) {
                return redirect()->back()->with('error', 'Course not found');
            }
    
            $lesson = new Lesson([
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'video_id' => $videoId,
                'duration' => $request->input('duration')
            ]);
    
            $lesson->course_id = $courseId;
            $lesson->save();
    
            return redirect()->back()->with('success', 'Lesson added successfully');

        }catch(\Exception $e){
            Log::error('Error while adding lesson: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding lesson');
        }

    }

    public function view($lessonId){
        try {
            $lesson = Lesson::findOrFail($lessonId);
            $course = $lesson->course;
            $lessons = $course->lessons; 
            $resources = $course->resources;


            return view('lessons.view', compact('lesson', 'course', 'resources', 'lessons'));

        } catch (\Exception $e) {
            Log::error('Error while viewing lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error viewing lesson: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $lessonId){
        try {
            $lesson = Lesson::findOrFail($lessonId);

            $request->validate([
                'title' => 'required|string|max:255',
                'link' => 'required|string',
                'duration' => 'required|numeric',
            ]);

            $videoId = $this->extractVideoId($request->input('link'));

            $lesson->update([
                'title' => $request->input('title'),
                'link' => $request->input('link'),
                'video_id' => $videoId,
                'duration' => $request->input('duration'),
            ]);

            return redirect()->back()->with('success', 'Lesson updated successfully!');
            
        } catch (\Exception $e) {
            Log::error('Error while updating lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete($lessonId){
        try {
            $lesson = Lesson::findOrFail($lessonId);

            $lesson->delete();

            return redirect()->back()->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function completeLesson(Request $request, $lessonId){
        try {
            $completed = $request->input('completed');
    
            $lesson = Lesson::findOrFail($lessonId);
            $user = Auth::user();
    
            $user->lessons()->syncWithoutDetaching([$lesson->id => ['completed' => !$completed]]);
    
            $messageType = $completed ? 'warning' : 'success';
            $message = $completed ? 'Lesson marked as incomplete' : 'Lesson marked as completed';
    
            return redirect()->back()->with($messageType, $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

}
