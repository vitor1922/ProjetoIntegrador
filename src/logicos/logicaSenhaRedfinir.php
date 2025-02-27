
<?php
session_start();
include('../../constantes.php');
include_once('../../data/conexao.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Verificar se o e-mail existe no banco
    $sql = "SELECT id_usuario FROM usuario WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        $_SESSION['mensagem'] = "E-mail não encontrado!";
        header("Location: " . BASE_URL . "/screens/signUp.php");
        exit;
    }

    // Gerar um token único
    $token = bin2hex(random_bytes(8)); // Gera um token aleatório seguro
    $validade = date("Y-m-d H:i:s", strtotime("+30 minutes")); // Token válido por 30 min

    // Salvar o token no banco de dados
    $sql = "INSERT INTO tokens_recuperacao (id, email, token, validade) VALUES (:id, :email, :token, :validade)";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':id' => $usuario['id'],
        ':email' => $email,
        ':token' => $token,
        ':validade' => $validade
    ]);

    // Montar o link de recuperação
    $linkRecuperacao = BASE_URL . "screens/redefinir_senha.php?token=" . $token;


// Enviar o e-mail de recuperação
$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'salaodebelezasenac@gmail.com'; // Seu e-mail
    $mail->Password = 'uaglhlufxmifsgiu'; // Sua senha de aplicativo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Remetente e destinatário
    $mail->setFrom('salaodebelezasenac@gmail.com', 'Suporte'); // Remetente
    $mail->addAddress($email); // Envia para o e-mail do usuário

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Perdeu a senha de acesso?';
    $mail->Body = "
        <h2>Recupere sua senha </h2>
        <p>Você solicitou a recuperação da sua senha. Para redefini-la, clique no link abaixo:</p>
        <p><a href='$linkRecuperacao'>$linkRecuperacao</a></p>
        <p>Este link expira em 30 minutos.</p>
    ";
    $mail->AltBody = "Para redefinir sua senha, acesse: $linkRecuperacao";

    // Enviar o e-mail
    $mail->send();
    $_SESSION['mensagem'] = "Um e-mail foi enviado com as instruções para recuperar sua senha.";
} catch (Exception $e) {
    $_SESSION['mensagem'] = "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}

header("Location: " . BASE_URL . "screens/signUp.php");
exit;
}
