<?php

include_once("../constantes.php")

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

<body>
  <?php
  include_once("./header.php");
  ?>
  <main>
    <div class="row">
      <div class="col-12">
        <div class="button fs-1 mx-3">
          <a href="#" role="button pb-5">
            <i class="bi bi-arrow-left text-black fw-bold"></i>
          </a>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center">
      <div class="card w-75 w-md-50">
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
    <div class="mb-3 form-check">
    <div class="mb-3 form-check">
    <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1">&#9733;</label>
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