<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EmailHelper;
use App\Models\User;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Check if the user is authenticated and has an empid
        if ($user && $user->empid) {
            $empid = $user->empid;

            // Call the helper method to send the OTP
            EmailHelper::sendOTPToUser($empid);

            return response()->json(['message' => 'OTP sent successfully']);
        } else {
            return response()->json(['error' => 'User not authenticated or empid not found'], 400);
        }
    }
}