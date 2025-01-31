<?php
session_start();
include_once("./constantes.php");
include_once('./data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;
$nome = $_SESSION['nome'] ?? NULL;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Maxwel/malinski/joao">
    <title>Salão de Beleza Senac</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class="container-fluid d-flex flex-column">
    <div>
        <?php include_once("./screens/header.php"); ?>

        <main>
            <!-- Imagem Parallax -->
            <div class="d-flex align-items-center justify-content-center bg-dark position-relative paralax1">
                <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte">
                    <h1 class="animate__animated animate__backInDown text-center">Bem-vindo ao Salão Senac <br> Um curso onde formam profissionais</h1>
                </div>
            </div>


            <div class="bg-dark position-relative paralax2">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold matte2 ">
                    <h2 class="animate__animated animate__backInLeft">Conheça nossos Serviços </h2>
                </div>
            </div>
            <!-- terminar o css amanha -->
            <div id="carouselExample" class="carousel slide" style="height: 450px;">
                <div class="carousel-inner h-100">
                    <!-- Slide 1 -->
                    <a href="verTodosServicos.php">
                        <div class="carousel-item active h-100">
                            <img src="./assets/img/side-view-man-getting-haircut.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Cabeleireiro">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold" style="background-color: rgba(0, 0, 0, 0.6);">
                                Cabeleleiro
                            </div>
                        </div>
                    </a>
                    <!-- Slide 2 -->
                    <a href="verTodosServicos.php">
                        <div class="carousel-item h-100">
                            <img src="./assets/img/female-bare-feet-hands-manicure-pedicure-concept.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Manicure e Pedicure">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold" style="background-color: rgba(0, 0, 0, 0.6);">
                                Pedicure
                            </div>
                        </div>
                    </a>
                    <!-- Slide 3 -->
                    <a href="verTodosServicos.php">
                        <div class="carousel-item h-100">
                            <img src="./assets/img/close-up-man-hairstylist-indoors.jpg" class="d-block w-100 h-100 object-fit-cover" alt="Barbeiro">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white fs-2 fw-bold" style="background-color: rgba(0, 0, 0, 0.6);">
                                Barbeiro
                            </div>
                        </div>
                </div></a>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>

            <div class="bg-warning py-5 px-3 d-flex">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 justify-content-center d-flex">
                            <h1 class="fw-bold">Agende Seu Horário</h1>
                            <a href="<?= BASE_URL ?>screens/agendamento.php" class="btn btn-light text-primary fw-bold">Agendar um Horário</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Seção de Agendamento
            <div class="bg-primary text-white py-5 text-center">
                
            </div> -->
        </main>
    </div>

    <?php include("./screens/footer.php"); ?>
    <script src="./src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/script.js"></script>
    <script src="./src/magic-master/gulpfile.js"></script>
</body>

</html>