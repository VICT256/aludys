<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function sendMail($toEmail, $subject, $message) {

    $mail = new PHPMailer(true);

    try {
        //Server settings
         $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // $mail->isSMTP();                                            //Send using SMTP
        
        // $mail->Host       = 'localhost ';                     //Set the SMTP server to send through
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption  SMTPSecure = PHPMailer::ENCRYPTION_SMTPS
        // $mail->Port       = 25;//TCP port to connect to; use 587 if you have set ``
        
        $mail->Host       = 'server97-2.web-hosting.com';   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'info@reliancepropertiesrealtor.com';                     //SMTP username
        $mail->Password   = '#Image101%';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption  SMTPSecure = PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set ``
        
        
        //Recipients
        $mail->setFrom('info@reliancepropertiesrealtor.com', "Reliance Properties");
        $mail->addAddress($toEmail);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $email_template = $message;
        $mail->Body    = $email_template;

        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

 }
