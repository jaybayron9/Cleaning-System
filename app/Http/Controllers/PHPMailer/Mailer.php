<?php

namespace App\Http\Controllers\PHPMailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer extends Controller
{
    private $mailer;

    public function __construct() { 
        $this->mailer = new PHPMailer(true);
        $this->mailer->SMTPDebug = 0;
        $this->mailer->isSMTP();
        $this->mailer->Host       = env('MAIL_HOST');
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = env('MAIL_USERNAME');
        $this->mailer->Password   = env('MAIL_PASSWORD');
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port       = env('MAIL_PORT');
    }

    public function send($to, $subject, $body) {
        try { 
            $this->mailer->setFrom(
                env('MAIL_USERNAME'), 
                env('MAIL_FROM_ADDRESS')
            );

            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body; 

            $this->mailer->send(); 
            return true;
        } catch (Exception $err) {
            return response()->json([
                    'message' => "There was an error sending an email notification.",
                    'controller: ' => $err->getMessage(),
                    'mailer: ' => $this->mailer->ErrorInfo
            ]);
        }
    } 

    public function testsend() {
        $this->send('jaybayron400@gmail.com', 'Testsend', 'hello jay');
    }

    public function assignedRoomStatusTemplate($room, $status) {
        $backgroundColor = '';
        $textColor = '';

        switch ($status) { 
            case 'Approved':
                $backgroundColor = '#4caf50';
                $textColor = 'white';
                break;
    
            case 'Rejected':
                $backgroundColor = '#ef5350';
                $textColor = 'white';
                break;
            
            case 'Pending':
                $backgroundColor = '#ffeb3b';
                $textColor = 'black';
                break;
        }
    
        return '
            <div style="max-width: 700px; margin: 20px auto; padding: 20px;">
                <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: ' . $backgroundColor . '; color: ' . $textColor . '; border: 1px solid #ddd; border-radius: 5px;">
                    <p style="font-weight: bold;">
                        Room: ' . $room . ' 
                    </p>
                    <p>
                        Status: ' . $status . ' 
                    </p>
                </div>
            </div>';
    }
    

    public function forgot_temp($url = '') {
        return '
            <div style="max-width: 700px; margin: 20px auto; padding: 20px;">
                <img src="https://th.bing.com/th/id/OIG.FKx9Y_XzH._nfCa38tBz?pid=ImgGn" alt="Logo" style="display: block; max-width: 100px; height: auto; margin-bottom: 20px;">
                <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 5px;">
                    <h1 style="font-family: Arial, sans-serif; font-size: 24px; margin-top: 0;">Hi,</h1>
                    <p style="font-family: Arial, sans-serif; line-height: 1.5; margin-bottom: 20px;">
                        Someone (hopefully you!) requested a password reset for your account. Click the button below to choose a new password.
                    </p>
                    
                    <p style="text-align: center;">
                        <a href="'. $url .'" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;">Reset your password</a>
                    </p>
                    
                    <p style="font-family: Arial, sans-serif; line-height: 1.5; margin-bottom: 20px;">
                        If you did not request a password reset, you can simply ignore this message.
                    </p>
                    
                    <p style="font-family: Arial, sans-serif; line-height: 1.5;">Regards,<br>YourWeb</p>
                </div>

                <p style="text-align: center;">
                    Have any questions about this email? Check our community forum at PJMT.com. <br>
                    Copyright © 2023 PJMT. All rights reserved.
                </p>
            </div>
        ';
    }

    public function email_ver_temp($url = '') {
        return '
            <div style="max-width: 700px; margin: 20px auto; padding: 20px;">
                <img src="https://th.bing.com/th/id/OIG.FKx9Y_XzH._nfCa38tBz?pid=ImgGn" alt="Logo" style="display: block; max-width: 100px; height: auto; margin-bottom: 20px;">
                <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #f7f7f7; border: 1px solid #ddd; border-radius: 5px;">
                    <h1 style="font-family: Arial, sans-serif; font-size: 24px; margin-top: 0;">Hi,</h1>
                    <p style="font-family: Arial, sans-serif; line-height: 1.5; margin-bottom: 20px;">
                        Thank you for registering with YourWeb. To complete your email verification, please click the button below.
                    </p>
                    
                    <p style="text-align: center;">
                        <a href="'. $url .'" style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;">Verify Email</a>
                    </p>
                    
                    <p style="font-family: Arial, sans-serif; line-height: 1.5; margin-bottom: 20px;">
                        If you did not create an account with YourWeb, you can simply ignore this message.
                    </p>
                    
                    <p style="font-family: Arial, sans-serif; line-height: 1.5;">Regards,<br>YourWeb</p>
                </div>

                <p style="text-align: center;">
                    If you have any questions, please contact our support team at support@yourweb.com. <br>
                    Copyright © 2023 YourWeb. All rights reserved.
                </p>
            </div>
        ';
    }
}
