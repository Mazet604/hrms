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

            // Set the default timezone to the Philippines
            date_default_timezone_set('Asia/Manila');

            //Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            // 5 minute validity of OTP
            $validUntil = date('h:i A', strtotime('+5 minutes'));

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Login Confirmation';
            $mail->Body    = "
                <div style='background-color: #f9f9f9; padding: 20px; font-family: Arial, sans-serif; text-align: center;'>
                    <div style='background-color: white; border-radius: 8px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
                        <img src='https://i.imgur.com/YVsL4gX.jpeg' alt='Logo' style='max-width: 300px; margin-bottom: 20px;' />
                        <p style='color: #888; margin: 0;'>" . date('F d, Y') . "</p>
                        <h2 style='color: #25336B; margin: 10px 0;'>Your One Time Password</h2>
                        <p style='color: #c;'>
                            <strong>Do not share with other individuals. This is your OTP code:</strong> <br>
                            <span style='font-size: 24px; font-weight: bold;'>$otp</span>
                        </p>
                        <p style='color: #25336B; margin: 0; font-weight: bold;'>THIS OTP IS ONLY VALID UNTIL $validUntil</p>
                    </div>
                </div>
            ";

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