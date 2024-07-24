<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'emp_user' => 'required|string',
            'emp_pass' => 'required|string',
        ]);

        $user = User::where('emp_user', $request->emp_user)->first();

        if ($user && Hash::check($request->emp_pass, $user->emp_pass)) {
            Auth::login($user);
            return redirect()->intended('dashboard');
        }

        // Check if the username exists
        $userExists = User::where('emp_user', $request->emp_user)->exists();

        if ($userExists) {
            // Username exists but password is incorrect
            return redirect()->back()->with('error', 'Invalid password.');
        } else {
            // Username does not exist
            return redirect()->back()->with('error', 'Credentials do not exist.');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}