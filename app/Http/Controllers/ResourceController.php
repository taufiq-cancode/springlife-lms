<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class ResourceController extends Controller
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
            
            return view('resources.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving resources : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving resources');
        }   
    }
}
