<?php

include_once("../constantes.php");
include_once('../data/conexao.php');



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área do Instrutor</title>
  <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<?php
    include_once("./header.php");
    ?>
  <main>
      <!-- Container principal -->
  <div class="container-fluid h-100 d-flex flex-column align-items-center p-3">


<!-- Linha divisória superior -->
<hr class="w-100 my-0 border-2 border-dark">

<!-- Título principal -->
<h5 class="text-center fw-bold my-4">Área do instrutor</h5>

<!-- Linha divisória abaixo do título -->
<hr class="w-100 my-0 border-2 border-dark">

<!-- Abas com setas e texto em negrito -->
<div class="row w-100 d-flex justify-content-center align-items-center mb-3">
  <div class="col-auto">
    <i class="fas fa-chevron-left fa-lg text-dark"></i>
  </div>
  <div class="col-auto">
    <span class="fw-bold">Estoque</span> <!-- Texto "Estoque" em negrito -->
  </div>
  <div class="col-auto">
    <i class="fas fa-chevron-right fa-lg text-dark"></i>
  </div>
  <!-- Linha divisória superior -->
  <hr class="w-100 my-0 border-2 border-dark">
</div>



<!-- Lista de itens -->
<div class="list-group w-100">
  <!-- Repetição dos blocos -->
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 1</strong>
    <strong>• <?= $login['qtde'] ?> •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 2</strong>
    <strong>• 8/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 3</strong>
    <strong>• 5/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 4</strong>
    <strong>• 7/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 5</strong>
    <strong >• 9/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 6</strong>
    <strong>• 6/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 7</strong>
    <strong>• 4/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 8</strong>
    <strong>• 3/10 • </strong>
    <strong>XX/XX/XXXX</strong>
  </div>
  <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
    <strong>Bancada 9</strong>
    <strong>• 2/10 •</strong>
    <strong>XX/XX/XXXX</strong>
  </div>
</div>
</div>
<?php
    include("./footer.php");
    ?>
  </main>

  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>