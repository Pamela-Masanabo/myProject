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
     */
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response
    {
        // Check if staff member is logged in
        if (!Auth::check()) {

            return redirect()->route('login');
        }

        // Get logged-in staff member
        $user = Auth::user();

        // Check if the staff role is allowed
        if (!in_array($user->role, $roles)) {

            abort(
                403,
                'You are not authorized to access this page.'
            );
        }

        return $next($request);
    }
}