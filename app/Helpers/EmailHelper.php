<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;
use App\Models\User;

require base_path('vendor/autoload.php');

class EmailHelper
{
    public static function generateOTP($length = 6) {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= mt_rand(0, 9);
        }
        return $otp;
    }

    public static function sendOTPEmail($to, $otp) {
        // Validate email address
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            Log::error("Invalid email address: $to");
            return;
        }

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST'); // Calling .env config
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT');

            //Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "Do not share with other individuals. This is your OTP code: $otp";

            // Enable verbose debug output
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function($str, $level) {
                Log::debug("PHPMailer debug level $level; message: $str");
            };

            $mail->send();
            Log::info('OTP sent successfully to ' . $to);
        } catch (Exception $e) {
            Log::error("Failed to send OTP to $to. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    public static function sendOTPToUser($empid) {
        $user = User::where('empid', $empid)->first();
        if ($user && $user->emp_email) {
            $otp = self::generateOTP();
            self::sendOTPEmail($user->emp_email, $otp);
        } else {
            Log::error("User with empid $empid not found or email is missing.");
        }
    }
}