<!-- CRIADOR: MALINSKI -->

<?php include_once("../constantes.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>

<body class="vh-100">

    <?php include_once("./header.php"); ?>

    <main class="h-75">
        <div class="d-flex justify-content-lg-end justify-content-center mt-3 mt-lg-1 me-lg-3">
        </div>
        <div class="container d-flex justify-content-center mt-5 align-content-center ">
            <div class="cardPerfil card d-flex justify-content-center border-3 shadow-lg">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="../assets/img/R (1).jpg" class="card-img-top img-perfil-grande rounded-circle mt-4" alt="...">
                </div>
                <div class="card-body d-flex justify-content-center flex-column">

                    <h5 class="card-title">Apelido</h5> <br>
                    <p class="card-text">Nome Real</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Bio</li>
                    <li class="list-group-item">...</li>
                    <li class="list-group-item">(x) Visitas (x) Avaliações</li>
                </ul>
                <div class="card-body">
                <a href="./editarPerfil.php" class="btn border shadow-sm fs-4 fw-bold azul-senac border-3 rounded-4 d-flex justify-content-center mb-3">Editar Perfil</a>
                    <a href="./configuracoes.php" class="link-offset-2 link-underline link-underline-opacity-0"><div class="btn text-light shadow-sm fs-4 fw-bold btn-azul-senac border-3 rounded-4 d-flex justify-content-center " type="button" href="">Configurações</div></a>
                    <!-- <a href="#" class="card-link">Another link</a> -->
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