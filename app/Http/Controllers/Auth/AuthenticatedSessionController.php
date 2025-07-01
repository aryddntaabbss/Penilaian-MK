<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses request login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        $credentials = $request->validated();

        $user = \App\Models\User::where('npm', $credentials['identifier'])
            ->orWhere('nip', $credentials['identifier'])
            ->first();

        if (! $user || ! \Hash::check($credentials['password'], $user->password)) {
            \Illuminate\Support\Facades\RateLimiter::hit($request->throttleKey());

            return back()->withErrors([
                'identifier' => 'NPM/NIP/NIDN atau password salah.',
            ]);
        }

        \Illuminate\Support\Facades\Auth::login($user);

        \Illuminate\Support\Facades\RateLimiter::clear($request->throttleKey());

        return redirect()->intended(route('dashboard', absolute: false));
    }



    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
