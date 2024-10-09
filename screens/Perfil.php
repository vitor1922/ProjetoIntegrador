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

<body>

    <?php include_once("./header.php"); ?>

    <main>

        <div class="col">
            <div class="container d-flex justify-content-center">
                <div class="d-flex justify-content-center align-items-center flex-column vh-100">
                    <div class="d-flex justify-content-end w-100 mt-5">
                        <button class="btn text-primary border"><a href="./editarPerfil_Ze.php" class="link-offset-2 link-underline link-underline-opacity-0">Editar Perfil</a></button>
                    </div>
                    <img src="../assets/img/R (1).jpg" class="w-50 rounded-5" alt=""> <br>
                    <h1><strong>Apelido</strong></h1> <br>
                    <h5>Nome Real</h5> <br>
                    <h6>(x) Visitas (x) Avaliações </h6>
                    <h6>Biografia</h6> <br>
                    <button class="btn btn-primary"><a href="./configuracoes_Maxwel.php" class="link-offset-2 link-underline link-underline-opacity-0 text-light">Configurações</a></button>
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