<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // Convert the roles parameter to an array (it should already be an array due to the variadic parameter)
        $roles = is_array($roles) ? $roles : explode(';', $roles);
        // Check if the user is authenticated and has at least one of the provided roles
        if (Auth::check() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        // If the user doesn't have any of the roles, redirect or return an error response
        route('logout');
        return redirect()->route('login')->with('error','Permission error!'); // Or some other response
    }
}
