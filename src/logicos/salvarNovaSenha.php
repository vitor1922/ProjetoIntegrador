<?php
session_start();
include("../../data/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['email_recuperacao'])) {
        $_SESSION['mensagem'] = "Sessão expirada!";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }

    $email = $_SESSION['email_recuperacao'];
    $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Atualizar a senha do usuário no banco
    $sql = "UPDATE usuario SET senha = :nova_senha WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':nova_senha' => $novaSenha,
        ':email' => $email
    ]);

    // Excluir o token da tabela
    $sql = "DELETE FROM tokens_recuperacao WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([':email' => $email]);

    // Limpar sessão e redirecionar para login
    unset($_SESSION['email_recuperacao']);
    unset($_SESSION['token_recuperacao']);
    $_SESSION['mensagem'] = "Senha redefinida com sucesso!";
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
?>
