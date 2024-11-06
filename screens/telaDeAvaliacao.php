<!--Mayara-->
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
  <title>Tela de avaliação</title>
  <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="vh-100" >
  <?php
  include_once("./header.php");
  ?>
  <main class="h-75">
    <div class="row">
      <div class="col-12">
        <div class="button fs-1 mx-3">
          <a href="#" role="button pb-5">
            <i class="bi bi-arrow-left text-black fw-bold"></i>
          </a>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center">
      <div class="card w-75 w-md-50 pb-3">
  <div class="card-body">
    <h5 class="card-title laranja-senac fw-bold d-flex justify-content-center">Tela de Avaliação</h5>
    <p class="card-text">Como avaliaria sua experiência no Senac?</p>
    <div class="mb-3 form-check">
    <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Ruim
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
    Boa
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
    Ótima
  </label>
</div>
<p class="card-text">Qual nota você daria para o aluno que lhe atendeu?</p>

    <div class="stars">
            <i class="bi bi-star star" data-rating="1"></i>
            <i class="bi bi-star star" data-rating="2"></i>
            <i class="bi bi-star star" data-rating="3"></i>
            <i class="bi bi-star star" data-rating="4"></i>
            <i class="bi bi-star star" data-rating="5"></i>
        </div>
        <div class="mb-3 mt-2 col-12 col-md-7">
                <label for="exampleFormControlTextarea2" class="form-label">Deixe sua opnião (Máximo de 300 caracteres)</label>
                <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" maxlength="300"></textarea>
              </div>
            </div>
          </div>
          <div class="mx-4">
          <button class=" offset-7 col-4 offset-md-11 col-md-1 btn btn-azul-senac text-light" type="submit">Enviar</button>
          </div>

  </div>
</div>
      </div>
    </div>
  </main>

  <?php
  include_once("./footer.php");
  ?>
  <script src="../src/bootstrap/js/bootstrap.js"></script>
</body>

</html>