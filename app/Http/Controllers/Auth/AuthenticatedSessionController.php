<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
    
            $request->session()->regenerate();
    
            if (auth()->check() && auth()->user()->role === 'student_coordinator' || auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'zonal_coordinator' || auth()->user()->role === 'regional_coordinator' || auth()->user()->role === 'national_coordinator') {
                return redirect()->intended('campus-mission/dashboard'); // Adjust the route as necessary
            }
    
            return redirect()->intended(RouteServiceProvider::HOME);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
