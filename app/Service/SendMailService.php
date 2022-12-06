<?php

namespace App\Service;

use Illuminate\Support\Facades\Mail;

class SendMailService
{
    public function sendPaymentMail($email, $full_name, $phone_number, $password)
    {
        Mail::send('clients.mail.send-mail', [
            'email' => $email,
            'full_name' => $full_name,
            'phone_number' => $phone_number,
            'password' => $password
        ], function ($mail) use ($email) {
            $mail->from('thientamjvb@gmail.com');
            $mail->to($email);
            $mail->subject('Thông báo đăng ký tài khoản');
        });
    }
}
