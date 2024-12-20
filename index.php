<?php 

session_start();
include_once("./constantes.php");
include_once('./data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Maxwel">
    <title>Salão de Beleza Senac</title>
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
</head>

<body class="vh-100 d-flex flex-column justify-content-between">
    <div>
        <?php
        include_once("./screens/header.php");
        ?>

        <main class=" ">
            <div class="container-fluid">
                <div class="banner">
                    <div class="row">
                        <div class="col-12 blur">
                            <img class="img-home-page" src="./assets/img/img_salao_de_beleza.png" alt="imagem de um salão de beleza ">
                        </div>
                    </div>
                </div>
                <div class="home bg-gd-laranja-claro-senac pb-5 mt-5 px-5 ">
                    <div class="row d-flex justify-content-center">
                        <div class="  col-lg-4 col-md-12">
                            <h1 class="mt-5 laranja-senac fw-bold text-start fs-1">Um Salão de Beleza Gratuito</h1>
                            <p class="azul-senac">
                                Um salão escola feito para criar profissionais capazes de atuar nas varias áreas dos cuidados com a beleza. Ganhe um tratamento gratuito e personalizado enquanto ajuda na criação de profissionais de qualidade.
                            </p>
                        </div>
                        <div class=" offset-lg-1 col-lg-4 d-flex justify-content-center mt-lg-5 pt-lg-5">
                            <img src="./assets/img/img_mulher_lavando_cabelo.png" alt="imagem de uma mulher lavando o cabelo" class="img-index">
                        </div>
                    </div>
                </div>
                <div id="sobre" class="sobre bg-gd-azul-claro-senac pb-5 mt-5 px-5">
                    <div class="row d-flex flex-lg-row-reverse justify-content-center">
                        <div class=" offset-lg-1 col-lg-4 col-md-12">
                            <h1 class="mt-5 laranja-senac fw-bold text-start fs-1">Sobre Nós</h1>
                            <p class="azul-senac">
                                Desde 1946, o Serviço Nacional de Aprendizagem Comercial (SENAC) se destaca como o principal agente de educação profissional voltado para o Comércio de Bens, Serviços e Turismo no Brasil.
                                Com o intuito de expandir suas iniciativas, o SENAC apresenta o Salão Escola, um projeto educacional dedicado à formação de profissionais capacitados nas diversas áreas de cuidados com a beleza. Oferecemos uma ampla gama de cursos, incluindo barbeiro, cabeleireiro, depilação, manicure e pedicure, entre outros. Para garantir a qualidade da formação, disponibilizamos atendimento gratuito e personalizado a clientes que desejam participar dessa experiência.
                            </p>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center mt-lg-5 pt-lg-5">
                            <img src="./assets/img/img_predio_senac.png" alt="foto do prédio do senac matinhos/caioba" class="img-index">
                        </div>
                    </div>
                </div>
                <div class="servicos bg-gd-laranja-claro-senac pb-5 mt-5">
                    <div class="row d-flex justify-content-center">

                        <div class="card card-index border-0 rounded-0 shadow-sm p-0 mx-2 mb-1">
                            <div class="card-body">
                                <h5 class="card-title laranja-senac fw-bold">Cabeleireiro</h5>
                            </div>
                            <img src="./assets/img/img_cabeleireiro.png" class="card-img rounded-0" alt="...">
                        </div>
                        <div class="card card-index border-0 rounded-0 shadow-sm p-0 mx-2 mb-1">
                            <div class="card-body">
                                <h5 class="card-title laranja-senac fw-bold">Cabeleireiro</h5>
                            </div>
                            <img src="./assets/img/img_manicure_pedicure.png" class="card-img rounded-0" alt="...">
                        </div>
                        <div class="card card-index border-0 rounded-0 shadow-sm p-0 mx-2 mb-1">
                            <div class="card-body">
                                <h5 class="card-title laranja-senac fw-bold">Cabeleireiro</h5>
                            </div>
                            <img src="./assets/img/img_barbeiro.png" class="card-img rounded-0" alt="...">
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-10 col-11 text-end">
                            <button class="btn btn-azul-senac text-white fw-bold"> Ver Todos</button>
                        </div>
                    </div>
                </div>
                <div class="cadastro bg-gd-azul-claro-senac pb-5 mt-5 px-5 ">
                    <div class="row d-flex justify-content-center">
                        <div class="  col-12">
                            <h1 class="mt-5 laranja-senac fw-bold text-center fs-1">Agende Seu Horário </h1>

                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 text-center">
                            <p class="azul-senac">
                                Faça agora seu cadastro gratuitamente e <br> agende um atendimento para cuidar de si.
                            </p>
                        </div>
                    </div>
                    <div class="row pb-5 mb-5">
                        <div class="col-12 d-flex justify-content-center">
                        <div class="">
                                <a href="<?= BASE_URL ?>screens/agendamento.php"  class="btn btn-azul-senac text-white fw-bold">Agendar um Horário</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contato" class="contato bg-gd-laranja-claro-senac pb-5 mt-5 px-5 ">
                    <div class="row d-flex justify-content-center">
                        <div class=" offset-1 col-lg-4 col-md-12 mb-2 ">
                            <h1 class="mt-5 laranja-senac fw-bold text-start fs-1">Fale Conosco</h1>
                            <p class="azul-senac">
                                Entre em contato com a gente para tirar suas duvidas e nos fornecer suas criticas e sugestões
                            </p>
                            <div class="">
                                <button class="btn btn-azul-senac text-white fw-bold"> <i class="bi bi-whatsapp"></i> entrar em contato</button>
                            </div>
                        </div>
                        <div class="offset-1 col-lg-4 text-start mt-lg-5 pt-lg-5">
                        <p class="azul-senac">
                        <i class="bi bi-telephone-fill"></i> (41) 99999-9999
                        </p>
                        <p class="azul-senac">
                        <i class="bi bi-geo-alt-fill"></i> R. Doutor José Pinto Rebelo Junior, 91 
                        </p>
                        <p class="azul-senac">
                        <i class="bi bi-envelope-fill"></i> caioba@pr.senac.br
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include("./screens/footer.php") ?>


    <script src="./src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>