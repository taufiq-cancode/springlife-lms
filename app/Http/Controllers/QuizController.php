<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class QuizController extends Controller
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
            
            return view('quiz.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }

    public function view(){
        try{
            // $user = auth()->user();  
            // if(!$user){
            //     return redirect()->back()->with('error', 'Unauthorized access');
            // }

            // $courses = Course::all();

            // if (!$courses) {
            //     return redirect()->back()->with('error', 'Courses not found');
            // }
            
            return view('quiz.view');

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }
}
