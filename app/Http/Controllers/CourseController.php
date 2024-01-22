<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(){
        try{

            $courses = Course::all();
            
            return view('courses.index', compact('courses'));

        }catch (\Exception $e){
            Log::error('Error while retrieving courses : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving courses');
        }        
    }

    public function store(Request $request){
        try{
            $user = auth()->user();  

            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'files.*' => 'file|mimes:pdf|max:20480',
            ]);
    
            $course = Course::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'cover_image' => $request->hasFile('cover_image') ? $request->file('cover_image')->store('course_images', 'public') : null,
            ]);

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                
                foreach ($files as $file) {
                    $path = $file->store('course_resources', 'public');
                    
                    $resource = new Resource([
                        'title' => $request->input('title'),
                        'files' => json_encode([$path]), 
                        'description' => $request->input('description'),
                        'cover_image' => $request->hasFile('cover_image') ? $request->file('cover_image')->store('resource_images', 'public') : null,
                    ]);
    
                    $course->resources()->save($resource);
                }
            }
    
            return redirect()->route('courses.index')->with('success', 'Course created successfully!');

        }catch (\Exception $e){
            Log::error('Error while creating course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }

        
    }

    public function view($courseId){
        try{

            $course = Course::findOrFail($courseId);
            $resources = $course->resources;


            return view('courses.view', compact('course', 'resources'));

        }catch(\Exception $e){

            Log::error('Error while viewing course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }
}
