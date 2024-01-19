<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
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
            
            return view('profile.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving profile : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving profile');
        }        
    }
}
