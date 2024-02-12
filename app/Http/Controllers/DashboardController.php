<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Course;


class DashboardController extends Controller
{
    public function index(){
        try{

            $courses = Course::all();
            
            return view('dashboard', compact('courses'));

        }catch (\Exception $e){

            Log::error('Error while accessing dashboard: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error accessing dashboard');

        }        
    }
}
