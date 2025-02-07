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
    
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body class="container-fluid d-flex flex-column">
    <div>
        <?php include_once("./screens/header.php"); ?>
        <div class="linha-vermelha"></div>

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
            <div class="linha-vermelha"></div>
            <!-- terminar o css amanha -->
            <section class="products">
                <div class="product">
                    <h1>Cortes</h1>
                    <small>lorem ipsu dolor</small>
                    <p>lorem ipsum dolor</p>
                </div>

                <div class="product">
                    <h1>Unhas</h1>
                    <small>lorem ipsu dolor</small>
                    <p>lorem ipsum dolor</p>
                </div>

                <div class="product">
                    <h1>Depilação</h1>
                    <small>lorem ipsu dolor</small>
                    <p>lorem ipsum dolor</p>
                </div>
            </section>

            <div class="bg-warning py-5 px-6 d-flex">
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
    <div class="linha-vermelha"></div>
    <?php include("./screens/footer.php"); ?>
    <script src="./src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/script.js"></script>
    <script src="./src/magic-master/gulpfile.js"></script>
</body>

</html>