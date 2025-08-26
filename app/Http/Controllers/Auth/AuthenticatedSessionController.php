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
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();

    //     $user = $request->user();

    //     if ($user->role === 'admin' || $user->role === 'instructor') {
    //         return redirect()->intended('/admin'); // Arahkan ke panel admin
    //     }

    //     // Jika bukan instruktur/admin, arahkan ke dashboard biasa
    //     return redirect()->intended(route('dashboard', absolute: false));
    // }
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if (in_array($request->user()->role, ['admin', 'instructor'])) {
            return redirect('/admin'); // Redirect langsung ke /admin
        }

        return redirect('/dashboard'); // Redirect langsung ke /dashboard
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return redirect('/');

        return redirect()->route('login');
    }
}
