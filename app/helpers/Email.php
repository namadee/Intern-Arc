<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Email{

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

     public function sendLoginEmail(){
          $this->mail->isHTML(true);
          $this->mail->Subject = 'Just a Test Email';
          $this->mail->setFrom('ruchira.commercialtp@gmail.com');
          $this->mail->Body = 'This is email Body';
          $this->mail->addAddress('ruchira.bogahawatta@gmail.com');
          $this->mail->Send();
          $this->mail->smtpClose();
     }


}