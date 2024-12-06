<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if ($perfil != 'professor' && $perfil != 'admin') {
    header('Location:' . BASE_URL . 'index.php');
}

$paginaAnterior = $_SERVER['HTTP_REFERER'] ?? BASE_URL . "index.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Área do Instrutor</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    include_once("./header.php");
    ?>

    <div class="container-fluid mt-3">
        <a href="<?=$paginaAnterior?>" class="btn btn-link">
            <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
        </a>
    </div>

    <main class="flex-grow-1">
        <div class="container-fluid mt-2">
            <div class="row justify-content-center">

                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column align-items-center ard-area-instrutor border-0 ">
                            <div class="">
                                <img src="../assets/img/img_usuarios.png" class=" img-210" alt="imagem de usuarios">

                            </div>
                            <div class="card-body mt-0 pt-0">
                                <h5 class="card-title text-center fs-2 fw-bold laranja-senac">Usuários</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="./gerenciamentoCursos.php" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column align-items-center ard-area-instrutor border-0 ">
                            <div class="">
                                <img src="../assets/img/img_gerenciamento.png" class=" img-210" alt="imagem de gerenciamento">

                            </div>
                            <div class="card-body mt-0 pt-0">
                                <h5 class="card-title text-center fs-2 fw-bold laranja-senac">Gerenciamento</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column align-items-center ard-area-instrutor border-0 ">
                            <div class="">
                                <img src="../assets/img/img_estoque.png" class=" img-210" alt="imagem de estoque">

                            </div>
                            <div class="card-body mt-0 pt-0">
                                <h5 class="card-title text-center fs-2 fw-bold laranja-senac">Estoque</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column align-items-center ard-area-instrutor border-0 ">
                            <div class="">
                                <img src="../assets/img/img_avaliacoes.png" class=" img-210" alt="imagem de avaliações">

                            </div>
                            <div class="card-body mt-0 pt-0">
                                <h5 class="card-title text-center fs-2 fw-bold laranja-senac">Avaliações</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="" class="text-decoration-none text-dark">
                        <div class="card d-flex flex-column align-items-center ard-area-instrutor border-0 ">
                            <div class="">
                                <img src="../assets/img/img_agendamentos.png" class=" img-210" alt="imagem de agendamentos">

                            </div>
                            <div class="card-body mt-0 pt-0">
                                <h5 class="card-title text-center fs-2 fw-bold laranja-senac">Agendamentos</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-auto">
        <?php include_once("./footer.php"); ?>
    </footer>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>