<?php
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar agendamento</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css" class="">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<style>
    /* * {
        box-shadow: 0px 0px 2px rgba(255, 0, 0, 0.8);
    } */
</style>

<body>
    <?php
    include("./header.php")
    ?>

    <main>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col">
                    <div class="button fs-1 mx-3 pb-5">
                        <a href="#" role="button pb-5">
                            <i class="bi bi-arrow-left text-black fw-bold"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-14 text-center">
                    <h2 class="laranja-senac fw-bold pb-5">Serviços disponíveis</h2>
                </div>
            </div>
            <div class="row ">
                <div class="row">
                    <div class="col-lg-4 col-sm-6 pb-3 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card 1</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <p class="d-inline-flex gap-1">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                        Button with data-bs-target
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample1">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 pb-3 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card 2</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <p class="d-inline-flex gap-1">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                        Button with data-bs-target
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample2">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 pb-3 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card 3</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <p class="d-inline-flex gap-1">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                        Button with data-bs-target
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample3">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botao text-center pt-5 pb-5 fs-1">
                    <button class="btn btn-primary" type="submit">Confirmar</button>
                </div>
            </div>
    </main>

    <?php
    include("./footer.php")
    ?>
    <script src="../src/bootstrap/js/bootstrap.js"></script>
</body>

</html>