<?php

include_once("../constantes.php");
include_once('../data/conexao.php');

session_start();
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

if (!$logado) {
  header("Location: " . BASE_URL . "screens/signUp.php");
  exit; 
}
// Mostrar dados do agendamento
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  // $id_agendamento = $_GET["id_agendamento"];
  $sql = "SELECT * FROM agendamento WHERE id_agendamento = :id_agendamento ";
  $select = $conexao->prepare($sql);
  $select->bindParam(':id_agendamento', $id_agendamento);
  if ($select->execute()) {
    $login = $select->fetch(PDO::FETCH_ASSOC);
  }
} 

// echo ("<pre>");
// var_dump($login);
// die;


unset($conexao);
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

<body class="container-fluid d-flex flex-column justify-content-between">
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
          <div class="col-12 text-center mb-5">
            <h1 class=" laranja-senac fw-bold">Seu agendamento<br>foi concluído<br>com sucesso</h1>
          </div>
        </div>

        <div class="row d-flex justify-content-center">

          <!--Resumo do agendamento-->
          <div class=" col-12 col-lg-6 d-flex justify-content-center mb-4">
            <div class="card shadow-lg w-30rem ">
              <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top img-fluid p-3" alt="...">
              <div class="card-body">
                <div class="row">
                  <div class=" col-6">
                    <h5 class="card-title fs-6 text-start">Lavagem de cabelo</h5>
                  </div>
                  <div class="col-6">
                    <h5 class="card-title fs-6 text-end"><?= $login["data"]?></h5>
                  </div>
                  <div class="row">
                  <div class="col-12 text-center mb-1">
                    <h5 class="p-0 m-0 fs-6 text-danger">Cancele antes do dia marcado para não receber avisos</h5>
                  </div>
                </div>

                <div class="mb-3  d-flex justify-content-center">
                  <button class="btn  btn-danger  text-white fw-bold px-5" type="submit">Cancelar</button>
                </div>
                </div>
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