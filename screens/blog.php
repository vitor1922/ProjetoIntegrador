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
      <div class="mt-4">
        <div class="row mb-3">
          <div class=" col-6 d-flex align-items-center ">
            <h3 type="text" class="text-start fs-1 fw-bold laranja-senac">Blog</h3>
            <?php if ($perfil == "admin" || $perfil == "professor" || $perfil == "aluno") { ?>
              <button type="button" class="ms-2 btn btn-primary btn-azul-senac" data-bs-toggle="modal" data-bs-target="#modalAdicionarPost">Adicionar Post</button>
            <?php } ?>
          </div>
        </div>
      </div>



      <div class=" row d-flex justify-content-center">
        <!-- card -->
        <div class="card card-post border col-lg-3 m-1">

          <!-- Carrossel de imagens -->
          <div class=" d-flex justify-content-center align-items-center">
            <div id="carouselExampleInterval" class="row slide-blog carousel slide">
              <div class="carousel-inner">
                <div class="carousel-item active">
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
          <!--info-->
          <div class=" row ">
            <div class="col-6">
              <div class="row">
                <div class="">
                  <img src="https://th.bing.com/th/id/OIP._eCIljHRA15vp38zaPRE4QHaHR?rs=1&pid=ImgDetMain" alt="Foto de perfil" class="img-perfil-mini">
                  <label class="fs-7">Nome do aluno </label>
                </div>
              </div>

              <div class="row fs-5 ms-1">Título do Post</div>


            </div>
            <div class="col-6 pt-3 ">
              <div class="row d-flex justify-content-end pe-3 fs-5">nome do curso</div>
              <div class="row d-flex justify-content-end pe-3">turma 21321</div>
              <div class="row d-flex justify-content-end pe-3 fs-7">data da postagem</div>


            </div>
            <div class="row  ps-4 pt-4 text-secondary">açslkdfjasçlfkjasdçlfkasdjfçl ksajfçlkasdjfçlasdkjfçlasdkjfçlasdknjfml lçkjadsf lk fdsajl fjslkf ldskça flk adsflk adslk fldas jlfk d</div>
          </div>
        </div>


        <!-- fim card -->
        






        <!-- MODAL ADICIONAR CURSO -->
        <div class="modal fade" id="modalAdicionarPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../src/logicos/adicionarPost.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Título do Post</label>
                    <input type="text" class="form-control" name="txtCurso" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Texto</label>
                    <input type="text" class="form-control" name="txtCurso" required>
                  </div>

                  <div class="mb-3">
                    <input type="text" class="form-control" name="txtCurso" value="" required>
                  </div>
                 
                  <div class="mb-3">
                    <label class="form-label fw-bold">Adicionar Imagem do Curso</label>
                    <input type="file" multiple name="imgCurso" class="form-control" accept="image/png, image/jpeg">
                  </div>

                  <div class="mb-3 d-flex justify-content-center">
                    <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                  </div>
                </form>
              </div>
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