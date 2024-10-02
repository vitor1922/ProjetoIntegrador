<?php

include_once("../constantes.php")

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviço - Corte de Cabelo</title>
  <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <?php
  include_once("./header.php");
  ?>
  <main>
    <div class="container">
      <!-- Flecha de retorno -->
      <div class="m-3">
        <i class="bi bi-arrow-left"></i>
      </div>
      <div class="row text-center mt-5 mb-3">
        <h3 class="display-6 text-warning fw-bold">Corte de Cabelo</h3>
      </div>
      <div class="row d-flex align-items-center mb-3 w-100 w-md-50 w-lg-25 mx-auto">
        <div class="col text-center">
          <p class="mt-3 fw-bolder text-primary">Exemplo dos serviços anteriores</p>
        </div>
      </div>
      <div class="carrosel d-flex justify-content-center">
        <!-- Carrossel de imagens -->
        <div id="carouselExampleIndicators" class="carousel slide w-75">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <!-- Primeiro slide -->
              <div class="row">
                <div class="col-3">
                  <!-- Conteudo do Quadrado -->
                  <div class="card" style="height:200px;"></div>
                </div>
                <div class="col-3">
                  <!-- Conteudo do Quadrado -->
                </div>
                <div class="col-3">
                  <!-- Conteudo do Quadrado -->
                </div>
                <div class="col-3">
                  <!-- Conteudo do Quadrado -->
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <!-- Segundo slide -->
            </div>
            <div class="carousel-item">
              <!-- terceiro slide -->
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Voltar</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Proximo</span>
          </button>
        </div>
      </div>

      <!-- Descrição do serviço -->
      <p class="azul-senac mt-5 px-3">Lorem ipsum dolor sit amet. A iste architecto et distinctio sapiente hic atque dolores. Et sunt nihil in rerum consequuntur vel perferendis nostrum vel magni dolor eum.</p>
    </div>
  </main>


  <!-- JavaScript do Bootstrap -->
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php include_once("./footer.php"); ?>
</body>

</html>