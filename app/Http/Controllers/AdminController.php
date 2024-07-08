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

class AdminController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
                $request->validate([
                    'firstname' => 'required|string',
                    'lastname' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                ]);
                
                $temporaryPassword = Str::random(8);

                $admin = new User();
                $admin->firstname = $request->firstname;
                $admin->lastname = $request->lastname;
                $admin->email = $request->email;
                $admin->role = 'admin';
                $admin->status = 0;
                $admin->password = Hash::make($temporaryPassword);
                $admin->save();

                // $token = Password::broker()->createToken($admin);
                // $admin->sendPasswordResetNotification($token);

            DB::commit();

            return redirect()->back()->with('success', 'Admin created successfully.');

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
    public function update(Request $request, $adminId)
    {
        try {
            DB::beginTransaction();
                $request->validate([
                    'firstname' => 'nullable|string',
                    'lastname' => 'nullable|string',
                    'email' => [
                        'nullable',
                        'email',
                        Rule::unique('users')->ignore($adminId),
                    ],
                ]);
                
                $admin = User::findOrFail($adminId);
                $admin->update([
                    'firstname' => $request->input('firstname'),
                    'lastname' => $request->input('lastname'),
                    'email' => $request->input('email'),
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Admin updated successfully.');


        } catch(ValidationException $e){
            DB::rollback();
            Log::error('Error while creating admin: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating admin: '. $e->getMessage());
    
        } catch(\Exception $e) {
            DB::rollback();
            Log::error('Error while creating admin: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating admin');
        }
    }
    public function delete(Request $request, $adminId)
    {
        try {
            $admin = User::findOrFail($adminId);
            $admin->delete();

            return redirect()->back()->with('success', 'Admin deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting admin: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
