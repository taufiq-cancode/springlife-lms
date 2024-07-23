<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bsLesson;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Course;

class CertificateController extends Controller
{
    public function index(){
        try{
            $user = auth()->user();  
            if(!$user){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $courses = Course::all();

            if (!$courses) {
                return redirect()->back()->with('error', 'Courses not found');
            }
            
            return view('certificates.index', compact('courses', 'user'));

        }catch (\Exception $e){
            Log::error('Error while retrieving certificates : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving certificates');
        }        
    }

    // public function showCertificate($userId, $courseId)
    // {
    //     $user = User::findOrFail($userId);
    //     $course = Course::findOrFail($courseId);

    //     return view('certificate', compact('user', 'course'));
    // }

    public function bsShowCertificate($userId)
    {
        $user = User::findOrFail($userId);

        return view('bs.certificate', compact('user'));
    }

    public function generateCertificate($userId, $courseId)
    {
        try {
            $user = User::findOrFail($userId);
            $course = Course::findOrFail($courseId);

            if ($user->hasCompletedCourse($course)) {
                $quizResult = QuizResult::where('user_id', $userId)
                                        ->where('course_id', $courseId)
                                        ->orderBy('score', 'desc')
                                        ->first();
                                        
                if ($quizResult && $quizResult->score >= 70) {
                    return view('certificate', compact('user', 'course'));
                } else {
                    return redirect()->back()->with('error', 'You have not passed the quiz for this course.');
                }
            } else {
                return redirect()->back()->with('error', 'You have not completed all lessons in this course.');
            }
        } catch (\Exception $e) {
            Log::error('Error while generating certificate: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while generating certificate');
        }
    }
}
