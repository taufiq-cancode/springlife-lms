<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ResourceController extends Controller
{
    public function index(){
        try{

            $user = auth()->user();
            $courses = [];

            if ($user->role === 'admin') {
                $courses = Course::orderBy('created_at', 'desc')->get();
            } elseif ($user->role === 'tutor') {
                $courses = $user->tutoredCourses()->orderBy('created_at', 'desc')->get();
            } else {
                $courses = Course::orderBy('created_at', 'desc')->get();
            }
            
            return view('resources.index', compact('courses'));

        }catch (\Exception $e){
            Log::error('Error while retrieving resources : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving resources');
        }   
    }

    public function download($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);

            // Use storage_path instead of public_path
            $filePath = storage_path("app/public/{$course->file}");

            if (file_exists($filePath)) {
                $filename = $course->title . '.pdf';

                $headers = [
                    'Content-Type' => 'application/pdf',
                ];

                return response()->download($filePath, $filename, $headers);
            } else {
                return redirect()->route('courses.index')->with('error', 'PDF file not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error while downloading file: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while downloading file');
        }
    }

    public function view($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);

            $filePath = storage_path("app/public/{$course->file}");

            if (file_exists($filePath)) {
                return response()->file($filePath);
            } else {
                return redirect()->route('courses.index')->with('error', 'PDF file not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error while viewing file: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while viewing file');
        }
    }  
}
