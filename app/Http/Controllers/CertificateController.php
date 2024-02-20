<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function generateCertificate($userId, $courseId){
        try{

            $user = User::findOrFail($userId);
            $course = Course::findOrFail($courseId);

            if ($user->hasCompletedCourse($course)){
                $html = view('certificate', compact('user', 'course'));

                $dompdf = app('dompdf');
                $dompdf->loadHtml($html);

                $dompdf->setPaper('A4', 'landscape');

                $dompdf->render();

                $pdfname = $user->firstname . " Certificate of Completion - SpringOfLife";

                return $dompdf->stream($pdfname . '.pdf');

            }else{
                return redirect()->back()->with('error', 'You have not completed all lessons in this course.');
            }

        }catch(\Exception $e){
            Log::error('Error while generating certificate: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while generating certificate');
        }
    }
    
}
