<?php
include("../constantes.php");
session_start();


if (!isset($_SESSION['token_recuperacao'])) {
    $_SESSION['mensagem'] = "Acesso inválido!";
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

$email = $_SESSION['email_recuperacao'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>

    <?php if (isset($_SESSION['mensagem'])): ?>
        <p><?php echo $_SESSION['mensagem']; unset($_SESSION['mensagem']); ?></p>
    <?php endif; ?>

    <form action="../src/logicos/salvarNovaSenha.php" method="POST">
        <label for="senha">Nova Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit">Salvar Senha</button>
    </form>
</body>
</html>
