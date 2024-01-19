<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index(){
        try{
            // $user = auth()->user();  
            // if(!$user){
            //     return redirect()->back()->with('error', 'Unauthorized access');
            // }

            return view('dashboard');

        }catch (\Exception $e){
            Log::error('Error while retrieving courses : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error accessing dashboard');
        }        
    }
}
