<?php
session_start();
include("../../data/conexao.php");
include("../../constantes.php");

// Função para verificar a força da senha
function verificarForcaSenha($senha){
    if (strlen($senha) < 8) return "A senha deve ter pelo menos 8 caracteres.";
    if (!preg_match('/[A-Z]/', $senha)) return "A senha deve conter pelo menos uma letra maiúscula.";
    if (!preg_match('/[a-z]/', $senha)) return "A senha deve conter pelo menos uma letra minúscula.";
    if (!preg_match('/\d/', $senha)) return "A senha deve conter pelo menos um número.";
    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $senha)) return "A senha deve conter pelo menos um caractere especial (!@#$%^&*).";
    return true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar se a sessão de recuperação de senha ainda está ativa
    if (!isset($_SESSION['email_recuperacao'])) {
        $_SESSION['mensagem'] = "Sessão expirada!";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }

    // Captura as senhas digitadas
    $novaSenha = $_POST['senha'] ?? '';
    $confirmaSenha = $_POST['confirma_senha'] ?? '';

    // Verificar se as senhas coincidem
    if ($novaSenha !== $confirmaSenha) {
        $_SESSION['mensagem'] = "As senhas não coincidem. Tente novamente.";
        header("Location: " . BASE_URL . "screens/redefinir_senha.php");
        exit;
    }

    // Verificar a força da senha
    $validacao = verificarForcaSenha($novaSenha);
    if ($validacao !== true) {
        $_SESSION['mensagem'] = $validacao;
        header("Location: " . BASE_URL . "screens/redefinir_senha.php");
        exit;
    }

    // Hash da nova senha
    $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

    // Atualizar a senha no banco de dados
    $email = $_SESSION['email_recuperacao'];
    $sql = "UPDATE usuario SET senha = :nova_senha WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([
        ':nova_senha' => $novaSenhaHash,
        ':email' => $email
    ]);

    // Excluir o token da tabela de tokens de recuperação
    $sql = "DELETE FROM tokens_recuperacao WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([':email' => $email]);

    // Limpar a sessão e redirecionar o usuário para a página de login
    unset($_SESSION['email_recuperacao']);
    unset($_SESSION['token_recuperacao']);
    $_SESSION['mensagem'] = "Senha redefinida com sucesso!";
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
?>