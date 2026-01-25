<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the authenticated user has the required role
        $user = Auth::user();

        //  If user does not exist, redirect to login
        if (!$user) return  redirect()->route('login');

        // user role in lowercase
        $userRole = strtolower($user->role ?? '');

        // allowed roles
        if (!in_array($userRole, $roles,  true)) {
            abort(Response::HTTP_FORBIDDEN, 'Not Permissable');
        }

        return $next($request);
    }
}
