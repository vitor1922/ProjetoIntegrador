<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');


$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

if ($perfil == 'professor') {
    $estiloTXT = "text-success";
} elseif ($perfil == 'aluno') {
    $estiloTXT = "text-primary";
} elseif ($perfil == 'cliente') {
    $estiloTXT = "text-warning";
} elseif ($perfil == 'admin') {
    $estiloTXT = "text-danger";
}

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
// Mostrar dados do usuario logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
if ($select->execute()) {
    $login = $select->fetch(PDO::FETCH_ASSOC);
}

//  echo("<pre>");
//  var_dump($login);
//  die;


unset($conexao);
?>

<?php include_once("../constantes.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="container-fluid flex-column justify-content-between">
    <!-- Header -->
    <?php
    include_once("./header.php");
    ?>
    <main>
        <div class="container-fluid text-center">
            <!-- Perfil -->
            <div class="profileP ">
                    <img src="../foto/<?= $login['foto'] ?>" class="imgPerfil bordaa <?= $estilo ?>" name="foto" alt="Imagem de perfil">
                </div>
            <h5 class="d-flex fw-bold justify-content-center m-0 mt-5 mb-3"><?= $login["nome"] ?></h5>
            <div class="bio mb-3">
                <p class="text-center"><?= $login["biografia"] ?></p>
            </div>

            <hr style="border: none; border-top: 1px solid black; width: 100%; margin: 30px 0;">

            <!-- Botão para adicionar foto -->
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-secondary w-38 h-100 d-flex align-items-center justify-content-center border border-dark">
                    <i class="bi bi-plus" style="font-size: 2rem; color: black;"></i>
                </button>
            </div>

            <!-- Galeria de fotos -->
            <div class="row d-flex justify-content-center g-2 mt-3 mb-3">

                <div class="col-4 col-md-2">
                    <a href=""><img src="https://th.bing.com/th/id/OIP.s12OIiziuNadhVOj2qWlRgAAAA?rs=1&pid=ImgDetMain" class="img-fluid rounded" alt="Foto 1"></a>
                </div>
            </div>
            <main>
        </div>
        <!-- Bootstrap JS -->
        <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <?php include_once("./footer.php"); ?>
</body>

</html>