<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CertificateController extends Controller
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
            
            return view('certificates.index');

        }catch (\Exception $e){
            Log::error('Error while retrieving certificates : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving certificates');
        }        
    }
    
}
