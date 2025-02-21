<?php
include ("../autoload.php");
include ("./src/logicos/configSMTP.php");

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);

try {
    //Server settings                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = SMTP_USER;                     //SMTP username
    $mail->Password   = SMTP_PASS;                               //SMTP password           //Enable implicit TLS encryption
    $mail->Port       = SMTP_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    //Recipients
    $mail->setFrom('jvictorgow3@gmail.com', 'Joao gomes');
    $mail->addAddress('bruno.wuo@docente.pr.senac.br', 'Bruno Wuo');    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'contato do site';
    $mail->Body    = 'seu pau e gigante <b>in bold!</b>';


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>