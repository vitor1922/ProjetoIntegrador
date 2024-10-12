<?php
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>
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
        <a href="./Perfil.php"><button class="btn"><i class="bi bi-arrow-left-short fs-1 azul-senac"></i></button></a>
    </div>

    <div class="d-flex justify-content-center">

        </div>
        <div class="container d-flex justify-content-center align-content-center">
            <div class="cardPerfil card d-flex justify-content-center border-3 shadow-lg">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="../assets/img/R (1).jpg" class="card-img-top img-perfil-grande rounded-circle mt-4" alt="...">
                </div>

                <div class="card-body d-flex justify-content-center flex-column mt-3">

                <div class="col d-flex">
                    <div class="mb-3 mx-1">
                        <label for="apelido" class="form-label">Novo Apelido</label>
                        <input type="text" placeholder="Apelido" id="apelido" class="form-control border-0 border-bottom">
                    </div>
                    <div class="mb-3 mx-1">
                        <label for="nome" class="form-label">Novo Nome</label>
                        <input type="text" placeholder="Nome" id="nome" class="form-control border-0 border-bottom">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea id="bio" class="form-control border-0 border-bottom" style="resize: none;" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam," rows="3"></textarea>
                    </div>
                </div>
                <div class="card-body">
                    <div class="btn text-light shadow-sm fs-4 fw-bold btn-azul-senac border-3 rounded-4 d-flex justify-content-center" id="confirmButton">Confirmar</div>
                </div>
            </div>
        </div>

    </main>

    <?php
    include("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>

</body>

</html>

