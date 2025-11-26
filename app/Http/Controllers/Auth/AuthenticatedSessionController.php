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
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ]);

    // Cek login memakai email atau username
    $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) 
                    ? 'email' 
                    : 'username';

    // Attempt login
    if (!Auth::attempt([$loginType => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
        return back()->withErrors([
            'login' => 'Data login salah, silakan periksa kembali.',
        ]);
    }

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard'));
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
