<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function createTutor(Request $request){
        try {
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]);

        } catch (\Exception $e) {

        }

    }
}
