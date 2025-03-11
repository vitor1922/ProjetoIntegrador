<?php
session_start();
include("../../data/conexao.php");
include("../../constantes.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $token = $_GET['token'];

    // Verifica se o token é válido e se ainda está dentro do tempo de expiração
    $sql = "SELECT * FROM tokens_recuperacao WHERE token = :token AND validade >= NOW()";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $tokenValido = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tokenValido) {
        // Salvar email e token na sessão e redirecionar para redefinir senha
        $_SESSION['email_recuperacao'] = $tokenValido['email'];
        $_SESSION['token_recuperacao'] = $token;
        header("Location: " . BASE_URL . "screens/redefinir_senha.php");
        exit;
    } else {
        $_SESSION['mensagem'] = "Código inválido ou expirado!";
        header("Location: " . BASE_URL . "screens/validar_codigo.php");
        exit;
    }
}
?>
