<?php
include_once("../constantes.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar agendamento</title>
    <meta>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css" class="">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <?php
    include("./header.php");
    ?>

    <main class="pb-5 mb-5">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="button fs-1 mx-3 pb-5">
                    <a href=""><img class="mb-2 font-size" src="../src/bootstrap/bootstrap-icons/icons/arrow-left.svg" alt="Voltar"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-14 text-center">
                    <h2 class="laranja-senac fw-bold pb-5">Serviços disponíveis</h2>
                </div>
            </div>
            <div class="row justify-content-center pb-5 mb-5">
                <div class="col-lg-3 col-md-6 pb-3 d-flex justify-content-center">
                    <div class="card" style="width: 22rem;">
                        <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6  col-lg-12  col-xxl-7">
                                    <h5 class="card-title">Lavagem de cabelo</h5>

                                </div>
                                <div class="col-12 col-xxl-5">
                                    <p class="d-inline-flex gap-1">
                                        <button class="btn btn-azul-senac text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                            Selecionar
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample1">
                                <div class="card card-body" style="position: absolute; z-index: 1; width: 100%;">
                                    <select class="form-select bg-warning-subtle" aria-label="Default select example">
                                        <option selected>Selecionar Horario</option>
                                        <option value="1">18/07/24 - 17:00 até 18:30</option>
                                        <option value="2">18/07/24 - 17:00 até 18:30</option>
                                        <option value="3">18/07/24 - 17:00 até 18:30</option>
                                        <option value="4">18/07/24 - 17:00 até 18:30</option>
                                    </select>
                                    <div class="position-relative pt-5">
                                        <div class="position-absolute bottom-0 end-0 pt-5">
                                            <button type="submit" class="btn btn-azul-senac text-light">
                                                Agendar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3 d-flex justify-content-center">
                    <div class="card" style="width: 22rem;">
                        <img src="../assets/img/img_salao_de_beleza.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-lg-12 col-xxl-7">
                                    <h5 class="card-title">Corte de cabelo</h5>

                                </div>
                                <div class="col-12 col-xxl-5">
                                    <p class="d-inline-flex gap-1">
                                        <button class="btn btn-azul-senac text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                            Selecionar
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample2">
                                <div class="card card-body" style="position: absolute; z-index: 1; width: 100%;">
                                    <select class="form-select bg-warning-subtle" aria-label="Default select example">
                                        <option selected>Selecionar Horario</option>
                                        <option value="1">18/07/24 - 17:00 até 18:30</option>
                                        <option value="2">18/07/24 - 17:00 até 18:30</option>
                                        <option value="3">18/07/24 - 17:00 até 18:30</option>
                                        <option value="4">18/07/24 - 17:00 até 18:30</option>
                                    </select>
                                    <div class="position-relative pt-5">
                                        <div class="position-absolute bottom-0 end-0 pt-5">
                                            <button type="submit" class="btn btn-azul-senac text-light">
                                                Agendar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3 d-flex justify-content-center">
                    <div class="card" style="width: 22rem;">
                        <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-lg-12 col-xxl-7 w-md-50">
                                    <h5 class="card-title">Lavagem de cabelo</h5>
                                </div>
                                <div class="col-12  col-xxl-5">
                                    <p class="d-inline-flex gap-1">
                                        <button class="btn btn-azul-senac text-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                            Selecionar
                                        </button>
                                    </p>
                                </div>
                            </div>
                            <div class="collapse" id="collapseExample3">
                                <div class="card card-body" style="position: absolute; z-index: 1; width: 100%;">
                                    <select class="form-select bg-warning-subtle" aria-label="Default select example">
                                        <option selected>Selecionar Horario</option>
                                        <option value="1">18/07/24 - 17:00 até 18:30</option>
                                        <option value="2">18/07/24 - 17:00 até 18:30</option>
                                        <option value="3">18/07/24 - 17:00 até 18:30</option>
                                        <option value="4">18/07/24 - 17:00 até 18:30</option>
                                    </select>
                                    <div class="position-relative pt-5">
                                        <div class="position-absolute bottom-0 end-0 pt-5">
                                            <button type="submit" class="btn btn-azul-senac text-light">
                                                Agendar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <?php
    include("./footer.php")
    ?>
    <script src="../src/bootstrap/js/bootstrap.js"></script>
</body>

</html>