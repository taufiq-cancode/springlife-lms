<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(){
        try{
            
            return view('profile.index');

        }catch (\Exception $e){
            return redirect()->back()->with('error', 'Error while retrieving profile');
        }        
    }

    public function update(Request $request){
        try{
            
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'nullable|date',
            ]);

            $user = Auth::user();
            $user->update($validatedData);

            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $user->save();
            }

            return redirect()->back()->with('success', 'Profile updated successfully!');

        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
