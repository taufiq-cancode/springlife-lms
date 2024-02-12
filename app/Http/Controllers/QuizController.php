<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class QuizController extends Controller
{
    public function index(){
        try{
            
            $courses = Course::all();
            
            return view('quiz.index', compact('courses'));

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }

    public function view(){
        try{
            
            
            return view('quiz.view');

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }
}
