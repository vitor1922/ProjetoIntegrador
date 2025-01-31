<?php
# Inicia as variáveis de sessão
include('../constantes.php');
include_once("../data/conexao.php");

session_start();

$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$nome = $_SESSION['nome'] ?? "";
$id_usuario_logado = $_SESSION['id_usuario'] ?? "";

// Redireciona para a página de login se não estiver logado
if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

// Verifica se um ID foi passado pela URL
$id_usuario = $_GET['id'] ?? null;

// Se não houver um ID na URL, exibe erro
if (!$id_usuario) {
    echo "Usuário não especificado.";
    exit;
}

// Busca os dados do usuário com base no ID passado na URL
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);

if ($select->execute()) {
    $usuario = $select->fetch(PDO::FETCH_ASSOC);
} else {
    $usuario = null;
}

// Verifica se o usuário foi encontrado
if (!$usuario) {
    echo "Usuário não encontrado.";
    exit;
}

// Define a borda do perfil com base no tipo de usuário visualizado
if ($usuario['perfil'] == 'professor') {
    $estilo = "bg-success";
} elseif ($usuario['perfil'] == 'aluno') {
    $estilo = " bg-primary";
} elseif ($usuario['perfil'] == 'cliente') {
    $estilo = " bg-warning";
} elseif ($usuario['perfil'] == 'admin') {
    $estilo = " bg-danger";
}

unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Perfil</title>
</head>

<body class="container-fluid">

    <?php include_once("./header.php"); ?>

    <main class="h-75 mt-5">
        <div class="container d-flex justify-content-center mt-5 align-content-center">
            <div class="card d-flex justify-content-center border-3 shadow-lg col-lg-12">
                <div class="headerPerfil d-flex justify-content-center align-items-center">
                    <div class="profile-background <?= $estilo ?>">
                        <div class="d-flex justify-content-start mt-5">
                            <img src="../foto/<?= $usuario['foto'] ?>" class="imgPerfil mt-4 bordaa" name="foto" alt="Imagem de perfil">
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex justify-content-center flex-column mt-5">
                    <h5 class="card-title d-flex justify-content-center fw-bold "><?= $usuario["nome"] ?></h5> <br>
                    <h6 class="card-text d-flex justify-content-center fw-bold" id="cargoProfile"><?= $usuario["perfil"] ?></h6> <br>
                </div>

                <ul class="list-group list-group-flush">
                    <p class="list-group-item"><?= $usuario["biografia"] ?></p>
                </ul>
            </div>
        </div>
    </main>

    <?php include "./footer.php"; ?>

    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>
