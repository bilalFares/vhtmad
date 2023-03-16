<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'vendor/autoload.php';
require 'phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/phpmailer/src/SMTP.php';


if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;   
    
    $mail->SMTPOptions = array(
    'ssl' => array(
             'verify_peer' => false,
             'verify_peer_name' => false,
             'allow_self_signed' => true
         )
    );
    $mail->isSMTP();                                            
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'vhtmad@gmail.com';
    $mail->Password   = "sdyxeogyiekqtnyx";//"1234@Vht";
    $mail->SMTPSecure = "tls";                                      
    $mail->Port = 587;    
    $mail->addReplyTo($email, $name);                                       

    //Recipients
    $mail->setFrom('vhtmad@gmail.com', $name);
    $mail->addAddress('vhtmad@gmail.com');

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = "<p>$message</p> <br/>\n $name<br/>\n $email <br/>\n";

    $mail->send();
    echo 'OK';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
