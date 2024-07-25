<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\EmailHelper;
use Illuminate\Support\Facades\Session;

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

            // Generate OTP and send email
            $otp = EmailHelper::generateOTP();
            
            // Log the email address for debugging
            \Log::info('User email: ' . $user->emp_email);

            // Check if email is valid before sending
            if (filter_var($user->emp_email, FILTER_VALIDATE_EMAIL)) {
                EmailHelper::sendOTPEmail($user->emp_email, $otp);
                // Store OTP in session
                Session::put('otp', $otp);
                return redirect()->route('otp.form');
            } else {
                \Log::error('Invalid email address: ' . $user->emp_email);
                return redirect()->back()->with('error', 'Invalid email address.');
            }
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

    public function showOTPForm()
    {
        return view('auth.otp');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $otp = $request->otp;
        $storedOtp = Session::get('otp');

        if ($otp === $storedOtp) {
            Session::forget('otp');
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP.');
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