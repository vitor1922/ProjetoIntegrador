<!-- CRIADOR: MALINSKI -->

<?php
#inicia as variaveis de sessão
include('../constantes.php');
include_once("../data/conexao.php");


session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

// $perfil = "cliente";
// border colors of each user role 
if ($perfil == 'professor') {
    $estilo = "border border-success border-3";
} elseif ($perfil == 'aluno') {
    $estilo = "border border-primary border-3";
} elseif ($perfil == 'cliente') {
    $estilo = "border border-warning border-3";
} elseif ($perfil == 'admin') {
    $estilo = "border border-danger border-3 ";
}

// coisa dos txt

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
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Perfil</title>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">

    <?php include_once("./header.php"); ?>

    <main class="container mt-5">

        <div class=" d-flex justify-content-center mt-4 align-content-center mb-5">
            <div class=" card d-flex border-4 shadow-lg col motherCard">
                <div class="headerPerfil ">
                    <div class="profile-background ">
                        <img src="../bannerP/<?= $login['banner'] ?>" class="img-fluid" name="banner" alt="Imagem de perfil">
                    </div>
                </div>
                <!-- antes tinha um card-body antes de d-flex felx-column -->
                <div class=" d-flex flex-column align-content-center flex-md-row flex-lg-row profileP ">
                    <img src="../foto/<?= $login['foto'] ?>" class="imgPerfil bordaa <?= $estilo ?>" name="foto" alt="Imagem de perfil">
                </div>
                <div class=" d-flex flex-column justify-content-center align-content-center txtPerfil">
                    <h5 class="d-flex fw-bold justify-content-center m-0 mt-5"><?= $login["nome"] ?></h5> <br>
                    <h6 class=" d-flex fw-bold justify-content-center m-0 <?= $estiloTXT ?>" id="cargoProfile"><?= $login["perfil"] ?></h6> <br>
                    <p class="text-center"><?= $login["biografia"] ?></p>
                </div>

                <div class="card-body d-flex flex-column justify-content-end align-items-center ">
                    <div class="row w-50 d-flex ">
                        <a href="./editarPerfil.php" class="btn border shadow-sm fw-bold laranja-senac border-3 rounded-4 mb-3 ">Editar Perfil</a>
                    </div>
                    <div class="row w-50 d-flex">
                        <a href="./configuracoes.php" class="btn border shadow-sm fw-bold laranja-senac border-3 rounded-4  mb-3">Cfg</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include "./footer.php";
    ?>
    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>