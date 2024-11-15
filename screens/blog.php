<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;



if ($_SERVER['REQUEST_METHOD'] === "POST"){
  if (!empty($_POST['txtTituloPost']) && !empty($_POST['txtTexto'])){
      $tituloPost = filter_input(INPUT_POST, "txtTituloPost", FILTER_SANITIZE_SPECIAL_CHARS);
      $conteudoPost = filter_input(INPUT_POST, "txtTexto", FILTER_SANITIZE_SPECIAL_CHARS);

      if (isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])) {
          $allowedTypes = ["image/png", "image/jpeg"];
          $fileType = mime_content_type($_FILES["foto"]["tmp_name"]);
          $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

          if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
              $nameFile = pathinfo($_FILES["foto"]["name"], PATHINFO_FILENAME);
              $imagem_url = hash("md5", $nameFile) . "." . $ext;
              $dir = "../foto/";
              move_uploaded_file($_FILES["foto"]["tmp_name"], $dir . $imagem_url);
          } else {
              $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
              header("Location: " . BASE_URL . "screens/blog.php");
              exit;
          }
      } else {

          $imagem_url = "";
      }

  }
}

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
      <div class="row text- mt-5 mb-3">
        <h3 class="display-6 text-warning fw-bold">Corte de Cabelo</h3>
      </div>
      <div class="d-flex mt-5"></div>
      <hr>
      <div class="row d-flex align-items-center mb-3 w-100 w-md-50 w-lg-25 mx-auto">
        <div class="col text-">
          <h4 class="mt-3 fw-bolder text-primary">Turma 1</h4>
        </div>
      </div>
      <hr>
      <div class="d-flex justify-content-lg-start">
      <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 50px; height: 50px;">
      <div class="d-flex mt-3 p-3 small">
      <p>Nome do aluno - dd/mm/aaaa</p>
      </div>
      </div>
      <h4 name="txtTituloPost">Titulo do Post</h4>
      <hr>
      <div class="carrosel d-flex justify-content-center  ">
        <!-- Carrossel de imagens -->
      <div id="carouselExampleIndicators" class="carousel slide w-75">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
            img
          </div>
          <div class="carousel-item">
            <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
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
      <hr>
      <div class="row d-flex align-items-center mb-3 w-100 w-md-50 w-lg-25 mx-auto">
        <div class="col text d-flex mb-3">
          <h4 class="mt-3 fw-bolder text-primary">Turma 2</h4>
        </div>
      </div>
      <div class="d-flex justify-content-lg-start">
      <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="rounded-circle img-fluid mb-3" style="width: 50px; height: 50px;">
      <div class="d-flex mt-3 p-3 small">
      <p>Nome do aluno - dd/mm/aaaa</p>
      </div>
      </div>
      <h4>Titulo do Post</h4>
      <hr>
      <div class="carrosel d-flex justify-content-center  ">
      <div id="carouselExample" class="carousel slide w-75">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://img.freepik.com/fotos-gratis/close-homem-cortando-cabelo_23-2149220543.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
      </div>

    </div>
  </main>


  <!-- JavaScript do Bootstrap -->
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include_once("./footer.php"); ?>
</body>

</html>