<!-- CRIADOR: MALINSKI -->

<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;

?>

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
</head>

<body class="d-flex flex-column justify-content-between">
    <!-- Header -->
    <?php
    include_once("./header.php");
    ?>

    <main>
        <div class="container text-center">
            <!-- Perfil -->
            <div class="position-relative mt-3">
                <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 120px; height: 120px;">
                <button class="btn btn-edit-profile position-absolute top-0 end-0 me-2" style="border-color: gray;">Editar Perfil</button>
            </div>
            <h4>APELIDO</h4>
            <p class="text-muted">Nome Real</p>
            <div class="bio mb-3">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
            </div>

            <!-- Botão Configurações -->
            <button class="btn btn-primary mb-4 w-100" style="max-width: 200px;">Configurações</button>

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
                <div class="col-4 col-md-2">
                <a href=""><img src="https://th.bing.com/th/id/OIP.CoeNYRYF8JXtPPwO_K_kTwAAAA?rs=1&pid=ImgDetMain" class="img-fluid rounded" alt="Foto 2"></a>
                </div>
                <div class="col-4 col-md-2">
                <a href=""><img src="https://th.bing.com/th/id/OIP.Nf1sMOBxzCN3bzvrOsDO0AAAAA?rs=1&pid=ImgDetMain" class="img-fluid rounded" alt="Foto 3"></a>
                </div>
                <div class="col-4 col-md-2">
                <a href=""><img src="https://homensquesecuidam.com/wp-content/uploads/2017/10/cortes-de-cabelo-masculino-curto-homens-que-se-cuidam-a.jpg" class="img-fluid rounded" alt="Foto 4"></a>
                </div>
                <div class="col-4 col-md-2">
                <a href=""><img src="https://th.bing.com/th/id/OIP.tBrXgx6vUU6ZxO9kyCPmrQAAAA?rs=1&pid=ImgDetMain" class="img-fluid rounded" alt="Foto 5"></a>
                </div>
                <div class="col-4 col-md-2">
                <a href=""><img src="https://homensquesecuidam.com/wp-content/uploads/2017/10/cortes-de-cabelo-masculino-curto-homens-que-se-cuidam-b.jpg" class="img-fluid rounded" alt="Foto 6"></a>
                </div>
            </div>
            <main>
        </div>
        <!-- Bootstrap JS -->
        <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <?php include_once("./footer.php"); ?>
</body>

</html>