<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang dimasukkan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Quick login helper for demo testing.
     */
    public function quickLogin(string $role)
    {
        if (! app()->environment(['local', 'testing', 'demo']) && ! config('app.debug')) {
            abort(403, 'Quick login tidak tersedia di lingkungan ini.');
        }

        $email = match ($role) {
            'student' => 'student@itats.ac.id',
            'reviewer' => 'reviewer@itats.ac.id',
            'admin' => 'admin@itats.ac.id',
            default => 'student@itats.ac.id',
        };

        $user = User::where('email', $email)->firstOrFail();
        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->route('dashboard')->with('success', "Berhasil masuk sebagai {$user->name} ({$user->role})");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
