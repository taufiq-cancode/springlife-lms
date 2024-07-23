<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         if ($request->is('bible-studies') || $request->is('bible-studies/*')) {
    //             return route('bible-studies.login');
    //         }
    //         return route('login');
    //     }
    // }
}
