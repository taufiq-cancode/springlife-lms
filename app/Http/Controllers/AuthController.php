<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $previousUrl = url()->previous();

        if (str_contains($previousUrl, '/bible-studies')) {
            return redirect('/bible-studies/login');
        }

        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('auth.bs-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();

            $request->session()->regenerate();

            $previousUrl = url()->previous();

            if (str_contains($previousUrl, '/bible-studies/login')) {
                return redirect()->intended('/bible-studies');
            }

            return redirect()->intended('/bible-studies');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
