<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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
        $request->authenticate();
         // Check if the authenticated user is active
       $user = Auth::user();

    if (!$user->is_active) {

        Auth::logout();

        return back()->withErrors([
            'email' => 'Your account has been deactivated. Please contact the administrator.',
        ]);
    }

        $request->session()->regenerate();

switch ($user->role) {

    case 'ADMIN':

        return redirect()->route('admin.dashboard');


    case 'RECEPTIONIST':

        return redirect()->route('reception.dashboard');


    case 'STAFF_NURSE':

        return redirect()->route('screening.dashboard');


    case 'PROFESSIONAL_NURSE':

        return redirect()->route('professional.dashboard');


    case 'DOCTOR':

        return redirect()->route('doctor.dashboard');


    default:

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'username' => 'Your account does not have a valid staff role.',
            ]);

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
