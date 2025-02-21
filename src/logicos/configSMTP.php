<?php

define("SMTP_HOST", "sandbox.smtp.mailtrap.io");
define("SMTP_PORT", "2525");
define("SMTP_USER", "034be3dac74cfb");
define("SMTP_PASS", "ba89cc4bb0b940");


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

?>

