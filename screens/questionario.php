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
  <title>Questionario</title>
  <meta name="author" content="NickTon">

  <link href="../src/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <?php
  include_once("./header.php");
  ?>
  <main>
    <div class="row mb-5">
      <div class="col-12">
        <div class="button fs-1 mx-3">
          <a href="#" role="button pb-5">
            <i class="bi bi-arrow-left-short azul-senac fw-bold"></i>
          </a>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center">
        <div class="card w-75 w-md-50 px-2 pb-3 border-0 shadow-lg pe-5">
          <div class="card-body">
            <h5 class="card-title laranja-senac fw-bold d-flex justify-content-center fs-2">Preferências de serviço</h5>
          </div>
          <p class="card-text ms-4 fs-5">Você possui algum tipo de alergia a algum produto de beleza?</p>
          <div class="mb-3 ms-2 form-check">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault1" id="simQuest" onclick="toggleTextarea('preferenceTextarea', true)" checked>
              <label class="form-check-label" for="simQuest">sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="flexRadioDefault1" id="naoQuest" onclick="toggleTextarea('preferenceTextarea', false)">
              <label class="form-check-label" for="naoQuest">não</label>
            </div>
            <div class="mb-3 mt-2 col-12 col-md-7" id="preferenceTextarea">
              <label for="exampleFormControlTextarea1" class="form-label">Quais tipos de produtos? <i>(Máximo de 300 caracteres)</i></label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="300"></textarea>
            </div> 
          </div>

          <p class="card-text ms-4 fs-5">Você possui algum tipo de preferência de como seu atendimento vai ser realizado?</p>
          <div class="mb-3 ms-2 form-check">
            <div class="form-check">
              <input class="form-check-input" type="radio" value="sim" name="flexRadioDefault2" id="simQuest2" onclick="toggleTextarea('preferenceTextarea2', true)" checked>
              <label class="form-check-label" for="simQuest2">sim</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="nao" name="flexRadioDefault2" id="naoQuest2" onclick="toggleTextarea('preferenceTextarea2', false)">
              <label class="form-check-label" for="naoQuest2">não</label>
            </div>
            <div class="mb-3 mt-2 col-12 col-md-7" id="preferenceTextarea2">
              <label for="exampleFormControlTextarea2" class="form-label">Quais tipos de preferências? <i>(Máximo de 300 caracteres)</i></label>
              <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" maxlength="300"></textarea>
            </div>
          </div>

          <div class="mx-4">
            <button class=" offset-7 col-5 offset-md-11 col-md-1 btn btn-azul-senac text-light mb-1" type="submit">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </main>


  <?php
  include_once("./footer.php");
  ?>
  <script src="../src/bootstrap/js/bootstrap.min.js"></script>
  <script src="../src/js/script.js"></script>

</body>

</html>