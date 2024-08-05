<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Models\bsLesson;
use App\Models\Course;
use App\Models\Chapter;
use Illuminate\Validation\Rules;
use App\Models\Zone;
use App\Models\CourseTutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

    public function bsIndex()
    {
        $users = User::whereHas('progress')->with(['progress', 'progress.bsLesson'])->get();
        $totalLessons = bsLesson::count();
        
        return view('bs.students.index', compact('users', 'totalLessons'));
    }

    public function coordinators()
    {
        try {
            $user = auth()->user();  
    
            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }
            
            $chapters = Chapter::all();  
            $zones = Zone::all();
         
            $studentCoordinators = User::where('role', 'student_coordinator')->get();
            $chapterCoordinators = User::with('chapter')->where('role', 'chapter_coordinator')->get();
            $zonalCoordinators = User::with('zone')->where('role', 'zonal_coordinator')->get();
            $regionalCoordinators = User::where('role', 'regional_coordinator')->get();
            $nationalCoordinators = User::where('role', 'national_coordinator')->get();

            return view('users.coordinators', compact('studentCoordinators', 'chapterCoordinators', 'zonalCoordinators', 'regionalCoordinators', 'nationalCoordinators', 'chapters', 'zones'));

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
                'chapter_id' => 'nullable|exists:chapters,id',
                'zone_id' => 'nullable|exists:zones,id',
                'region' => 'nullable|in:Western,Eastern,Southern',
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

            if ($request->chapter_id) {
                $user->chapter_id = $request->chapter_id;
            } 
            if ($request->zone_id) {
                $user->zone_id = $request->zone_id;
            } 
            if ($request->region) {
                $user->region = $request->region;
            }

            $user->save();

            $token = Password::broker()->createToken($user);
            $user->sendPasswordResetNotification($token);

            DB::commit();

            return redirect()->back()->with('success', 'User created successfully.');

        } catch (ValidationException $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating user: '. $e->getMessage());

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating user');
        }
    }

    public function createStudentCoordinator(Request $request)
    {
        $chapters = Chapter::all();          
        return view('auth.cm-student-register', compact('chapters'));
    }

    public function createChapterCoordinator(Request $request)
    {
        $zones = Zone::all();   
        $chapters = Chapter::all();          
     
        return view('auth.cm-chapter-register', compact('zones', 'chapters'));
    }

    public function storeStudentCoordinator(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'gender' => 'required|string|in:male,female,other',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'chapter_id' => 'required|exists:chapters,id',
            ]);
    
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->role = 'student_coordinator';
            $user->status = 1;
            $user->password = Hash::make($request->password);
            $user->chapter_id = $request->chapter_id;
    
            $user->save();
    
            Auth::login($user);
    
            DB::commit();
    
            return redirect()->intended('campus-mission')->with('success', 'Registration successful. You are now logged in.');
    
        } catch (ValidationException $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error during registration: '. $e->getMessage());
    
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error during registration: '. $e->getMessage());
        }
    }

    public function storeChapterCoordinator(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'gender' => 'required|string|in:male,female,other',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed',
                'chapter_id' => 'required|exists:chapters,id',
                'zone_id' => 'required|exists:zones,id',
            ]);

            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->role = 'chapter_coordinator';
            $user->status = 1;
            $user->password = Hash::make($request->password);
            $user->zone_id = $request->zone_id;
            $user->chapter_id = $request->chapter_id;

            $user->save();

            Auth::login($user);

            DB::commit();

            return redirect()->intended('campus-mission')->with('success', 'Registration successful. You are now logged in.');
        } catch (ValidationException $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error during registration: '. $e->getMessage());

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while creating user: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error during registration');
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
