<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseTutor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class TutorController extends Controller
{
    public function store(Request $request)
    {
        try {
            // DB::beginTransaction();
                $request->validate([
                    'course_id' => 'required|exists:courses,id',
                    'firstname' => 'required|string',
                    'lastname' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                ]);
                
                if (CourseTutor::where('course_id', $request->course_id)->exists()) {
                    return redirect()->back()->with('error', 'The course has already been assigned to a tutor.');
                }

                $temporaryPassword = Str::random(8);

                $tutor = new User();
                $tutor->firstname = $request->firstname;
                $tutor->lastname = $request->lastname;
                $tutor->email = $request->email;
                $tutor->role = 'tutor';
                $tutor->status = 0;
                $tutor->password = Hash::make($temporaryPassword);
                $tutor->save();

                $course = Course::findOrFail($request->course_id);
                $course->tutors()->attach($tutor->id);

                $token = Password::broker()->createToken($tutor);
                $tutor->sendPasswordResetNotification($token);

            // DB::commit();

            return redirect()->back()->with('success', 'Tutor created and assigned to course successfully.');

        } catch(ValidationException $e) {
            // DB::rollback();
                Log::error('Error while creating tutor: '. $e->getMessage());
                return redirect()->back()->with('error', 'Error while creating tutor: '. $e->getMessage());
        
        } catch(\Exception $e) {
            // DB::rollback();
                Log::error('Error while creating tutor: '. $e->getMessage());
                return redirect()->back()->with('error', 'Error while creating tutor');
        }

    }
    public function update(Request $request, $tutorId)
    {
        try {
            DB::beginTransaction();
                $request->validate([
                    'course_id' => 'nullable|exists:courses,id',
                    'firstname' => 'nullable|string',
                    'lastname' => 'nullable|string',
                    'email' => 'nullable|email|unique:users,email',
                ]);
                
                if (CourseTutor::where('course_id', $request->course_id)->exists()) {
                    return redirect()->back()->with('error', 'The course has already been assigned to a tutor.');
                }

                $tutor = User::findOrFail($tutorId);
                $tutor->update([
                    'course_id' => $request->input('course_id'),
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                ]);

                // $course = Course::findOrFail($request->course_id);
                // $course->tutors()->update($course);

            DB::commit();

            return redirect()->back()->with('success', 'Tutor updated successfully.');


        } catch(ValidationException $e){
            DB::rollback();
            Log::error('Error while creating tutor: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating tutor: '. $e->getMessage());
    
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('Error while creating tutor: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating tutor');
        }
    }
    public function delete(Request $request, $tutorId)
    {
        try {
            $tutor = User::findOrFail($tutorId);
            $tutor->delete();

            return redirect()->back()->with('success', 'Tutor deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting tutor: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
