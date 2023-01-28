<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    protected $receiver;
    protected $sender;
    protected $password;
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'ruchira.commercialtp@gmail.com';
        $this->mail->Password   = 'trvvwzxmhnonlilm';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port       = 587;
    }

    //Single Mail - Login Mail
    public function sendLoginEmail($email, $password, $username)
    {

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Getting Started with Intern Arc';
        $this->mail->setFrom('ruchira.commercialtp@gmail.com');

        $this->mail->Body = "
          <div style='background-color: #054a91; margin:0; padding: 0; height: 20px;'>

          </div>
          <div
              style='text-align: center;padding-top: 15px;'>
              <h2 style='margin:0 ;'>Hi <span style='color: #f17300;'>" . $username . "</span></h2>
              <h4 style='margin:5px;font-weight: 600;'>Welcome to Intern Arc</h4>
              <p>Now you can logged in to Intern Arc using following credentials.</p>
      
              <p style='margin: 0;text-align: center;'>Email</p>
              <p
                  style='padding:5px 10px;background-color: #dbe4ee;margin:0 auto;width: fit-content;font-weight: bold;text-align: center;margin-top: 5px;'>
                  " . $email . "</p>
              <p style='margin: 0;text-align: center;  margin-top: 10px;'>Password</p>
              <p
                  style='padding:5px 10px;background-color: #dbe4ee;margin:0 auto;width: 150px;font-weight: bold;text-align: center;margin-top: 5px;'>
                  " . $password . "</p>
              <p style='color:#f17300; margin: 0;'>
                  Please Change your password right after you logged in to the system</p>
          ";

        $this->mail->addAddress($email);
        $this->mail->Send();
        $this->mail->smtpClose();
    }

    //Forgot
    public function sendVerificationEmail($email, $username, $verification_code)
    {

        $this->mail->isHTML(true);
        $this->mail->Subject = 'Verification Code to Reset the Password';
        $this->mail->setFrom('ruchira.commercialtp@gmail.com');

        $this->mail->Body = "
        <div style='background-color: #054a91; margin:0; padding: 0; height: 20px;'>

        </div>
        <div
            style='text-align: center;padding-top: 15px;'>
            <h2 style='margin:0 ;'>Hi <span style='color: #f17300;'>" . $username . "</span></h2>
            <h4 style='margin:5px;font-weight: 600;'>Use the following verification code to reset your password</h4>
    
            <p style='margin: 0;text-align: center;'>Verification Code</p>
            <p
                style='padding:5px 10px;background-color: #dbe4ee;margin:0 auto;width: fit-content;font-weight: bold;text-align: center;margin-top: 5px;'>
                " . $verification_code . "</p>
        ";

        $this->mail->addAddress($email);
        $this->mail->Send();
        $this->mail->smtpClose();
    }
}
