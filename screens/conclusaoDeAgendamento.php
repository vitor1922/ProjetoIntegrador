<?php

include_once("../constantes.php")

//AUTOR - VICTOR
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
  <title>Agendamento Concluído</title>
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
      <div class="text-center mt-4 mb-3">
        <h3 class="display-6 laranja-senac fw-bold">Seu Agendamento<br>foi concluido<br>com sucesso!</h3>
      </div>
      <!-- Flecha de retorno -->
      <i class="fas fa-arrow-left fa-lg text-dark arrow-icon"></i> <!-- Flecha de retorno quase grudada no canto -->

      <div class="caixa1 d-flex justify-content-center mb-5">
        <div class="card w-50 h-75 ">
          <img src="https://educarr.com.br/wp-content/uploads/2018/05/Curso-de-Maquiagem-Escola-do-Legislativo-Foto-Lucas-Almeida-122-1024x683.jpg" class="card-img-top" alt="...">
          <div class="card-body d-flex justify-content-between">
            <p class="card-text">Manicure Pedicure </p>
            <p>20/26/2024-17:00 até 18:30</p>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <select class="form-select" aria-label="Default select example">
            <option selected>Questionário de preferências de serviço (opcional)</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          <p class="azul-senac d-flex justify-content-center mt-3 mb-0">Caso deixe ligado a seguinte opção, você receberá notificações em até 48 horas do dia marcado</p>
          <div class="card-body d-flex justify-content-center">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
            <label class="form-check-label" for="flexSwitchCheckDefault">Aceitar receber notificações por email ou telefone</label>
          </div>
          </div>
          <p class="text-danger d-flex justify-content-center">Cancele antes do dia marcado para não receber avisos</p>
          <div class="d-grid gap-2 col-3 mx-auto">
  <button class="btn btn-danger" type="button">Cancelar</button>
</div>
        </div>
      </div>

      <?php
    include("./footer.php");
    ?>
      <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>