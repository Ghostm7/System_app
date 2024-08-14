<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        foreach ($roles as $role) {
            if ($user && $user->hasRole($role)) {
                return $next($request);
            }
        }

        return redirect('/')->with('status', 'You do not have the right roles to access this page.');
    }
}

