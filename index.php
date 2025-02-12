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
    <link rel="stylesheet" href="./assets/css/elementosIndex.css">
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

            <section class="carousel-section"style="background: black;">
  <div class="container">
    <div class="card-carousel">
      <div class="card" id="1">
        <div class="image-container"></div>
        <p>1 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
      </div>
      <div class="card" id="2">
        <div class="image-container"></div>
        <p>2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
      </div>
      <div class="card" id="3">
        <div class="image-container"></div>
        <p>3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
      </div>
      <div class="card" id="4">
        <div class="image-container"></div>
        <p>4 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
      </div>
      <div class="card" id="5">
        <div class="image-container"></div>
        <p>5 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, explicabo!</p>
      </div>
    </div>
    <a href="#" class="visuallyhidden card-controller">Carousel controller</a>
  </div>
</section>


                    <style>
/* Reset global para eliminar margens/paddings padrões */
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
}

.section.carousel-section{
    background-color: #f5b916;
}
/* Estilos aplicados somente na seção do carousel */
.carousel-section .visuallyhidden {
  position: absolute;
  z-index: -1;
  right: 0;
  opacity: 0;
}

.carousel-section h1 {
  color: white;
  text-align: center;
  margin-top: 1em;
}

/* Container ocupa toda a largura e sem espaçamentos internos */
.carousel-section .container {
  overflow: hidden;
  padding: 3rem;         /* Remove o padding para usar 100% da largura */   /* 100% da largura da viewport */
  background: rgba(0, 0, 0, 0.1);
}

/* Estilos aplicados somente na seção do carousel */
.carousel-section .card-carousel {
  /* Aumenta a largura e a altura das cartas */
  --card-width: 90%;         /* Aumentei de 80% para 90% */
  --card-max-width: 400px;    /* Aumentei de 280px para 400px */
  --card-height: 500px;       /* Aumentei de 350px para 500px */
  
  z-index: 1;
  position: relative;
  margin: 0;
  width: 100%;
  height: var(--card-height);
  transition: filter 0.3s ease;
}

.carousel-section .card-carousel.smooth-return {
  transition: all 0.2s ease;
}

.carousel-section .card-carousel .card {
  background: whitesmoke;
  width: var(--card-width);
  max-width: var(--card-max-width);
  text-align: center;
  padding: 1em;
  min-width: 250px;
  height: var(--card-height);
  position: absolute;
  /* Em vez de margin: 0 auto, centralizamos com left + transform */
  left: 50%;
  transform: translateX(-50%);
  color: rgba(0, 0, 0, 0.5);
  transition: inherit;
  -webkit-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.3);
  border-radius: 1em;
  filter: brightness(0.9);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.carousel-section .card.highlight {
  filter: brightness(1);
}

.carousel-section .card:nth-of-type(1) .image-container {
  background-image: url("https://static.addtoany.com/images/dracaena-cinnabari.jpg");
}

.carousel-section .card:nth-of-type(2) .image-container {
  background-image: url("https://www.w3schools.com/w3css/img_lights.jpg");
}

.carousel-section .card:nth-of-type(3) .image-container {
  background-image: url("https://images.pexels.com/photos/414612/pexels-photo-414612.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500");
}

.carousel-section .card:nth-of-type(4) .image-container {
  background-image: url("https://images.pexels.com/photos/67636/rose-blue-flower-rose-blooms-67636.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500");
}

.carousel-section .card:nth-of-type(5) .image-container {
  background-image: url("https://helpx.adobe.com/content/dam/help/en/stock/how-to/visual-reverse-image-search/jcr_content/main-pars/image/visual-reverse-image-search-v2_intro.jpg");
}

/* Ajusta o contêiner da imagem para combinar com o novo tamanho das cartas */
.carousel-section .image-container {
  width: 10em;              /* Aumentado de 8em para 10em */
  height: 10em;             /* Aumentado de 8em para 10em */
  position: relative;
  background-size: cover;
  margin-bottom: 2em;
  border-radius: 100%;
  padding: 1em;
  -webkit-box-shadow: inset 0px 0px 17px 0px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: inset 0px 0px 17px 0px rgba(0, 0, 0, 0.3);
  box-shadow: inset 0px 0px 17px 0px rgba(0, 0, 0, 0.3);
}

.carousel-section .image-container::after {
  content: "";
  display: block;
  width: 120%;
  height: 120%;
  border: solid 3px rgba(0, 0, 0, 0.1);
  border-radius: 100%;
  position: absolute;
  top: calc(-10% - 3px);
  left: calc(-10% - 3px);
}

.carousel-section h2 {
  padding: 1em;
  margin-top: 1em;
  background: rgba(0, 0, 0, 0.3);
  text-align: center;
  color: white;
  border-radius: 0.2em;
  display: inline-block;
  transform: translateX(calc((100vw - 100%) / 2));
}

.carousel-section h2 a {
  color: #f5b916;
}



                    </style>




            <div class="custom-bg py-5 px-6 d-flex">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 d-flex flex-column align-items-center">
                            <!-- Título separado com margem inferior -->
                            <h1 class="fw-bold mb-3">Agende Seu Horário</h1>
                            <!-- Botão -->
                            <a class="fancy btn btn-primary" href="#">
                                <span class="top-key"></span>
                                <span class="text">Agendar</span>
                                <span class="bottom-key-1"></span>
                                <span class="bottom-key-2"></span>
                            </a>
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
    <script src="./src/js/index.js"></script>
</body>

</html>