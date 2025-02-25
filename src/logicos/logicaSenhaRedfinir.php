<?php
session_start();
require '../vendor/autoload.php'; // Certifique-se que está no caminho certo

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

//     if (empty($email)) {
//         $_SESSION['mensagem'] = "Preencha o e-mail!";
//         header("Location: " . BASE_URL . "screens/signUp.php"); // Redireciona para a página com o modal
//         exit;
//     }

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP do Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'jvictorgow3@gmail.com'; // Seu e-mail
        $mail->Password = 'pbdlnlxtsmkrhlwa'; // Sua senha ou senha de aplicativo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Remetente e destinatário
        $mail->setFrom('jvictorgow3@gmail.com', 'Seu Nome'); // E-mail do remetente
        $mail->addAddress('ursamaior532@gmail.com', 'Victor'); // E-mail do destinatário

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Assunto do E-mail';
        $mail->Body = '<h1>Olá Victor!</h1><p>Esta é uma mensagem enviada via PHPMailer.</p>';
        $mail->AltBody = 'Olá Victor! Esta é uma mensagem enviada via PHPMailer.'; // Caso o cliente de e-mail não suporte HTML

        // Enviar o e-mail
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }
    header("Location: " . BASE_URL . "screens/signUp.php"); // Redireciona para a página com o modal
    exit;
// }
