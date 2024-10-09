<?php

include_once("../constantes.php")

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
  <title>Agendamento Concluído</title>
  <meta name="author" content="Victor">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex flex-column justify-content-between">
  <div>
    <?php include_once("./header.php"); ?>

    <main>
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <a href=""><i class="bi bi-arrow-left-short fs-1 azul-senac"></i></a>
          </div>
        </div>

        <div class="row">
          <div class="col-12 text-center">
            <h1 class=" laranja-senac fw-bold">Seu agendamento<br>foi concluído<br>com sucesso</h1>
          </div>
        </div>

        <div class="row">

        </div>
        <div class="col-12 d-flex justify-content-center">
          <div class="card w-75 w-md-50 px-2 pb-3 border-0 shadow-lg">
            <div class="card-body">
            </div>
              
          </div>
        </div>

      </div>
    </main>

    <?php include("./footer.php"); ?>
  </div>
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>