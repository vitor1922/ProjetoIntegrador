<?php
include_once('../data/conexao.php');
include('../constantes.php');

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

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



if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id_post = $_GET['id_post'] ?? NULL;
    $sql = "SELECT * FROM post WHERE id_post = :id_post";
    $select = $conexao->prepare($sql);
    $select->bindParam(':id_post', $id_post);
    if ($select->execute()) {
        $post = $select->fetch(PDO::FETCH_ASSOC);
    }
}

unset($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <meta name="author" content="Jose">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="vh-75">
    <?php
    include_once("./header.php");
    ?>

    <main class="h-100 mt-3 mb-5">

        <div class="d-flex justify-content-between align-items-center">
            <a href="./Perfil.php"><button class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                        fill="currentColor" class="bi bi-arrow-left-short fs-1 azul-senac" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg></button></a>
        </div>
        <div class="container d-flex justify-content-center align-content-center">
            <div class="cardPerfil card border-3 shadow-lg">
                <form method="POST" action="<?= BASE_URL ?>src/logicos/updatePerfil.php">
                    <div class="headerPerfil d-flex">
                        <div class="profile-background">
                            <img src="../foto/<?= $login["foto"] ?>" class="imgPerfil mt-4" alt="">
                        </div>
                    </div>
                    <input type="file" class="inputs w-25 form-control" accept="image/jpg, image/png" onchange="previewImage(event)">
                    <input type="text" name="imgName" value="<?= $login["foto"] ?>" hidden>
                    <div class="card-body d-flex flex-column mt-5">
                        <input type="text" id="nomeTextInput" class="form-control" name="txtUserId"
                            value="<?= $login['id_usuario'] ?? '' ?>" hidden>
                        <h6 class="card-text d-flex justify-content-center" id="cargoProfile"> <?= $login['perfil'] ?? '' ?></h6>
                        <div class="col mt-5">
                            <div class="mb-3">
                                <div class="nomePerfil">
                                    <h6 class="mt-1 fw-bold laranja-senac mx-2">Nome Atual:</h6>
                                    <h5 class="card-title d-flex mx-1"><?= $login['nome'] ?? '' ?></h5> <br>
                                    <label for="nome" class="form-label fw-bold azul-senac mx-2">Novo Nome</label>
                                    <input type="text" name="txtNome" class="form-control border-0 border-bottom" value="<?= $login['nome'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="nomePerfil">
                            <div class="mb-3 mt-1 fw-bold">
                                <label for="bio" class="form-label fw-bold azul-senac mx-2">Bio</label>
                                <textarea class="form-control border-0 border-bottom" name="txtBiografia" rows="3"><?= $login['biografia'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn text-light shadow-sm fs-4 fw-bold btn-azul-senac border-3 rounded-4 d-flex justify-content-center w-100">Confirmar</button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <?php
    include("./footer.php");
    ?>


    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>

</body>

</html>