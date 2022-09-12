<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);

if(isset($_POST['send_email'])){

    // echo '<pre>';
    // print_r($_POST); die;
    // echo '</pre>';

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                           
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                  
        $mail->Username   = 'amoriotechonologies@gmail.com';                     
        $mail->Password   = 'bwskajgehkrdhkpa';                               
        $mail->SMTPSecure = 'tls';            
        $mail->Port       = 587;                                   

        //Recipients
        // $mail->setFrom('madhu@yopmail.com', 'Madhu');
        $mail->setFrom('madhu@yopmail.com', $firstname);
        $mail->addAddress('madhu@yopmail.com', 'Joe User');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment($image, 'Images');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = "<b> Firstname :</b>  $firstname "."<br> <b> Lastname :</b>  $lastname "."<br> <b> Email :</b>  $email "."<br>"."<b> Subject :</b>  $subject"."<br><b> Message :</b>  $message ";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
        echo "<script>alert('Email Send Successfull')</script>";
        echo "<script>window.location.href='contact.php'</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }