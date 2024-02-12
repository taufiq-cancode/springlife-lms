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

            $courses = Course::all();
            return view('resources.index', compact('courses'));

        }catch (\Exception $e){

            Log::error('Error while retrieving resources : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving resources');

        }   
    }

    public function download($courseId){
        try{
            $course = Course::findOrFail($courseId);

            $filePath = public_path("storage/course_files/{$course->file}");

            if (file_exists($filePath)) {
                $filename = $course->title . '.pdf';

                $headers = [
                    'Content-Type' => 'application/pdf',
                ];

                return response()->download($filePath, $filename, $headers);
            } else {
                return redirect()->route('courses.index')->with('error', 'PDF file not found.');
            }

        }catch(\Exception $e){
            Log::error('Error while downloading file: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
}
