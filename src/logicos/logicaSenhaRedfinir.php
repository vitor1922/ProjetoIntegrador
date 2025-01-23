<?php
include_once("./data/conexao.php");
include_once("./constantes.php");
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $email = $_POST['email'];

//     // Verifica se o e-mail existe
//     $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
//     $stmt->bindParam(':email', $email);
//     $stmt->execute();

//     if ($stmt->rowCount() > 0) {
//         // Gera um token único e salva no banco
//         $token = bin2hex(random_bytes(32)); // Token seguro
//         $validade = date('Y-m-d H:i:s', strtotime('+1 hour'));

//         $stmt = $pdo->prepare("INSERT INTO tokens_recuperacao (email, token, validade) VALUES (:email, :token, :validade)");
//         $stmt->bindParam(':email', $email);
//         $stmt->bindParam(':token', $token);
//         $stmt->bindParam(':validade', $validade);
//         $stmt->execute();

//         // Envia o e-mail com o link
//         $link = "https://seusite.com/resetar-senha.php?token=$token";
//         mail($email, "Redefinição de Senha", "Clique no link para redefinir sua senha: $link");

//         echo "Um e-mail foi enviado para redefinição de senha.";
//     } else {
//         echo "E-mail não encontrado.";
//     }
// }



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './/vendor/phpmailer/phpmailer/src/Exception.php';
require './/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './/vendor/phpmailer/phpmailer/src/SMTP.php';

// Instância da classe
$mail = new PHPMailer(true);
try
{
    // Configurações do servidor
    $mail->isSMTP();        //Devine o uso de SMTP no envio
    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
    $mail->Username   = 'salaodebelezasenac@gmail.com';
    $mail->Password   = 'salaoblzpi@2024';
    // Criptografia do envio SSL também é aceito
    $mail->SMTPSecure = 'tls';
    // Informações específicadas pelo Google
    $mail->Host = 'smtp.email.com';
    $mail->Port = 587;
    // Define o remetente
    $mail->setFrom('salaodebelezasenac@gmail.com', 'Senac');
    // Define o destinatário
    $mail->addAddress('emaildestinatario@gmail.com', 'Nome Destinatario');
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Teste Envio de Email';
    $mail->Body    = 'Este é o corpo da mensagem <b>Olá!</b>';
    $mail->AltBody = 'Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML';
    // Enviar
    $mail->send();
    echo 'A mensagem foi enviada!';
}
catch (Exception $e)
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>