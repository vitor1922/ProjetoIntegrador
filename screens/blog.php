<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;





?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviço - Corte de Cabelo</title>
  <meta name="author" content="Victor">
  <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="container-fluid">
  <?php
  include_once("./header.php");
  ?>
  <main>
    <div class="container">
      <!-- Flecha de retorno -->
      <div class="m-3">
        <i class="bi bi-arrow-left"></i>
      </div>
      <div class="row text- mt-5 mb-3">
        <h3 class="display-6 laranja-senac fw-bold">Blog</h3>
      </div>



<div class="flex-wrap">
<!-- card -->
      <div class="card card-post border">
        <div class=" row ">
          <div class="col-6">
            <div class="row">
              <div class="">
                <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="img-perfil-mini">
                <label class="">Nome do aluno</label>
              </div>
            </div>
            <div class="row ms-1"> data da postagem</div>
            <div class="row fs-5 ms-1">Título do Post</div>

            
          </div>
          <div class="col-6">
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>

          </div>
        </div>
        <!-- Carrossel de imagens -->
        <div class=" d-flex justify-content-center align-items-center">
          <div id="carouselExampleInterval" class="row slide-blog carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card card-post border">
        <div class=" row ">
          <div class="col-6">
            <div class="row">
              <div class="">
                <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="img-perfil-mini">
                <label class="">Nome do aluno</label>
              </div>
            </div>
            <div class="row ms-1"> data da postagem</div>
            <div class="row fs-5 ms-1">Título do Post</div>

            
          </div>
          <div class="col-6">
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>

          </div>
        </div>
        <!-- Carrossel de imagens -->
        <div class=" d-flex justify-content-center align-items-center">
          <div id="carouselExampleInterval" class="row slide-blog carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card card-post border">
        <div class=" row ">
          <div class="col-6">
            <div class="row">
              <div class="">
                <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="img-perfil-mini">
                <label class="">Nome do aluno</label>
              </div>
            </div>
            <div class="row ms-1"> data da postagem</div>
            <div class="row fs-5 ms-1">Título do Post</div>

            
          </div>
          <div class="col-6">
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>
            <div class="row">nome do curso</div>

          </div>
        </div>
        <!-- Carrossel de imagens -->
        <div class=" d-flex justify-content-center align-items-center">
          <div id="carouselExampleInterval" class="row slide-blog carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>

      </div>

    </div>
  </main>


  <!-- JavaScript do Bootstrap -->
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php include_once("./footer.php"); ?>
</body>

</html>