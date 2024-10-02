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
    <h5 class="card-title laranja-senac fw-bold d-flex justify-content-center">Prefêrencias de serviço</h5>
    <p class="card-text">Você possui algum tipo de alergia a algum produto de beleza?</p>
    <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Sim</label>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Não</label>
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