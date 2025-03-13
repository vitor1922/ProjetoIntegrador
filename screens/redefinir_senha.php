<?php
session_start();
include("../constantes.php");
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil = $_SESSION['perfil'] ?? NULL;
$_SESSION['mensagem'] = NULL;

if (!isset($_SESSION['token_recuperacao'])) {
    $_SESSION['mensagem'] = "Acesso inválido!";
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
$email = $_SESSION['email_recuperacao'];
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="J0A0 GOMES">
    <title>Faça login</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>


<body class="d-flex justify-content-between flex-column min-vh-100 p-0">
    <?php
    include_once('./header.php');
    ?>
    <main class="d-flex justify-content-center align-items-center ">
        <div class=" container form-container d-flex justify-content-center align-items-center">
            <div class="col-10 col-md-6 col-lg-6 bg-light p-3 rounded-4 shadow-lg">
                <h5 class="text-center mb-3 mt-2 text-warning">Nova Senha</h5>
                <hr class="border-warning" style="border-width: 3px;">
                <form action="../src/logicos/salvarNovaSenha.php" method="POST">
                    <div class="form-group mt-4">
                        <label for="nova_senha">Senha</label>
                        <input type="password" class="form-control bg-light" id="" name="NovaSenha" aria-describedby="emailHelp" placeholder="Digite sua nova senha" required>
                    </div>
                    <div class="form-group mb-3 mt-4">
                        <label for="ConfirmarNova_senha">autenticar Senha</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control bg-warning-subtle border-right-0" id="confirmarNovaSenha" name="nova_senha" placeholder="Digite sua nova senha corretamente" required>
                            <div class="input-group-text border-left-0">
                                <i class="bi-eye-fill text-start" id="iconPasswordSenha" onclick="viewSenhaNova()"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Recuperar Senha</button>
                </form>
            </div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert alert-warning mt-2">
                    <?= $mensagem ?>
                </p>
            <?php } ?>
    </main>
    <?php
    include("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script src="../src/js/cep.js"></script>
</body>

</html>