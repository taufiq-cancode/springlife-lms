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
use Illuminate\Validation\Rule;


class TutorController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'course_id' => 'nullable|exists:courses,id',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ]);

            $temporaryPassword = Str::random(8);

            $tutor = new User();
            $tutor->firstname = $request->firstname;
            $tutor->lastname = $request->lastname;
            $tutor->email = $request->email;
            $tutor->role = 'tutor';
            $tutor->status = 0;
            $tutor->password = Hash::make($temporaryPassword);
            $tutor->save();

            if ($request->filled('course_id')) {
                $course = Course::findOrFail($request->course_id);

                $course->tutors()->sync([$tutor->id]);

                $token = Password::broker()->createToken($tutor);
                $tutor->sendPasswordResetNotification($token);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Tutor created and assigned to course successfully.');

        } catch(ValidationException $e) {
            DB::rollback();
            Log::error('Validation error while creating tutor: '. $e->getMessage());
            return redirect()->back()->with('error', 'Validation error while creating tutor: '. $e->getMessage());

        } catch(\Exception $e) {
            DB::rollback();
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
                'email' => [
                    'nullable',
                    'email',
                    Rule::unique('users')->ignore($tutorId),
                ],
            ]);

            $tutor = User::findOrFail($tutorId);

            if ($request->filled('course_id') && CourseTutor::where('course_id', $request->course_id)->where('tutor_id', '!=', $tutorId)->exists()) {
                return redirect()->back()->with('error', 'The course has already been assigned to another tutor.');
            }

            $tutor->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
            ]);

            if ($request->filled('course_id')) {
                $tutor->courses()->sync([$request->course_id]);
            } else {
                $tutor->courses()->detach();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Tutor updated successfully.');

        } catch (ValidationException $e) {
            DB::rollback();
            Log::error('Error while updating tutor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating tutor: ' . $e->getMessage());

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating tutor: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating tutor');
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
