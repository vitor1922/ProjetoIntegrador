<?php

include_once("../constantes.php")

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    include_once("./header.php");
    ?>
    <div class="container">
        <!-- Linha divisória abaixo do título -->
        <hr class="w-100 my-0 border-2 border-dark">
        <!-- Flecha de retorno -->
        <div class="m-3">
            <i class="bi bi-arrow-left fs-3"></i>
        </div>
        <div class="titulo d-flex justify-content-between">
            <div class="row mt-2 mb-3 p-2">
                <h3 class="display-6 fw-bolder">Bancada 1</h3>
            </div>
            <div class="d-flex mt-2 p-2"><i class="azul-senac bi bi-send fs-3"></i></div>
        </div>


        <!-- Linha divisória abaixo do título -->
        <hr class="w-100 my-0 border-2 border-dark">
        <div class="conteudo d-flex justify-content-center">
            <div class="row mt-2 mb-3 p-2">
                <h3 class="display-6 fw-bolder">Estoque</h3>
            </div>
        </div>

        <class="link-dark link-underline link-underline-opacity-0 rounded-1" href="">
            <div class="row bg-light mt-5 text-center shadow-sm border-bottom border-2">
                <div class="col">
                    <p class="mt-3 fw-bold">Escova</p>
                </div>
                <div class="col">
                    <p class="mt-3 fw-bold text-danger"><i class="azul-senac bi bi-plus"></i>2<i class="bi bi-dash"></i>
                    </p>
                </div>
            </div>
            </class=>
    </div>

    <i class="bi bi-plus"></i>


    <!-- JavaScript do Bootstrap -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>