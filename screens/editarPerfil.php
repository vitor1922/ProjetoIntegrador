<?php
include_once('../data/conexao.php');
include('../constantes.php');
include_once('../data/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <meta name="author" content="José">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="vh-100">
    <?php
    include_once("./header.php");
    ?>

    <main class="h-75">

        <div class="d-flex justify-content-between align-items-center">
            <a href="./Perfil.php"><button class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-left-short fs-1 azul-senac" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg></button></a>
        </div>

        <div class="container d-flex justify-content-center align-content-center">
            <div class="cardPerfil card d-flex justify-content-center border-3 shadow-lg">
                <div class="headerPerfil d-flex justify-content-center align-items-center">
                    <div class="profile-background d-flex">
                        <img src="../assets/img/R (1).jpg" class="imgPerfil mt-4" alt="Imagem de perfil" id="img_post">
                    </div>
                </div>

                <div class="card-body d-flex flex-column mt-5">

                    <h6 class="card-text d-flex justify-content-center mt-3">Cargo</h6>

                    <div class="col mt-5">
                        <div class="mb-3">
                            <label for="nome" class="form-label" id="nome">Novo Nome</label>
                            <input type="text" id="nome" class="form-control border-0 border-bottom">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea id="bio" class="form-control border-0 border-bottom" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-body">
                        <form>
                            <button type="submit" class="btn text-light shadow-sm fs-4 fw-bold btn-azul-senac border-3 rounded-4 d-flex justify-content-center w-100" id="confirmButton">Confirmar</button>
                        </form>
                    </div>
                </div>
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