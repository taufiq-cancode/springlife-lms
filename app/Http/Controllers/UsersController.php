<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    public function index()
    {
        try {
            $users = User::where('role', 'user')->get();
            $tutors = User::where('role', 'tutor')->get();
            $admins = User::where('role', 'admin')->get();
            $courses = Course::with('tutors')->get();

            return view('users.index', compact('users', 'tutors', 'admins', 'courses'));

        } catch(\Exception $e) {
            Log::error('Error while fetching data: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while fetching data');
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $request->validate([
                    'firstname' => 'required|string',
                    'lastname' => 'required|string',
                    'gender' => 'required|string|in:male,female,other',
                    'email' => 'required|email|unique:users,email',
                    'role' => 'required|string|in:admin,chapter_coordinator,zonal_coordinator,regional_coordinator,national_coordinator',
                ]);
                
                $temporaryPassword = Str::random(8);

                $user = new User();
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->gender = $request->gender;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->status = 0;
                $user->password = Hash::make($temporaryPassword);
                $user->save();

                $token = Password::broker()->createToken($user);
                $user->sendPasswordResetNotification($token);

            DB::commit();

            return redirect()->back()->with('success', 'User created successfully.');

        } catch(ValidationException $e) {
            DB::rollback();
                Log::error('Error while creating admin: '. $e->getMessage());
                return redirect()->back()->with('error', 'Error while creating admin: '. $e->getMessage());
        
        } catch(\Exception $e) {
            DB::rollback();
                Log::error('Error while creating admin: '. $e->getMessage());
                return redirect()->back()->with('error', 'Error while creating admin');
        }
    }
    public function update(Request $request, $userId)
    {
        try {
            DB::beginTransaction();
                $request->validate([
                    'firstname' => 'nullable|string',
                    'lastname' => 'nullable|string',
                    'gender' => 'nullable|string|in:male,female,other',
                    'email' => [
                        'nullable',
                        'email',
                        Rule::unique('users')->ignore($userId),
                    ],
                    'gender' => 'nullable',
                    'date_of_birth' => 'nullable|date',
                ]);

                $user = User::findOrFail($userId);
                $user->update([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                    'gender' => $request->input('gender'),
                    'date_of_birth' => $request->input('date_of_birth'),
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'User updated successfully.');


        } catch(ValidationException $e){
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating user: '. $e->getMessage());
    
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating user');
        }
    }
    public function delete(Request $request, $userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->delete();

            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting user: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
