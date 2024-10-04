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

<body>
    
        <?php include_once("./header.php"); ?>
    
    <main>
        <div class="container d-flex min-vh-100">

            <button class="btn d-flex">Editar Perfil</button>
            <div class="d-flex flex-column justify-content-center">

                <img src="" alt="">
                <h2>Apelido</h2>
                <h3>Nome Real</h3>
                <h6>(x) Visitas</h6>
                <h6>(x) Avaliações</h6>
                <h4>Biografia</h4>
                <button class="btn">Configurações</button>
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