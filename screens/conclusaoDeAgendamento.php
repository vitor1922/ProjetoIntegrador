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
$login = NULL;

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

echo ("<pre>");
var_dump($data);
die;


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
                    <h5 class="card-title fs-6 text-end"><?= $agendamento["data"] ?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <!--Opções gerais-->
          <div class=" col-12 col-lg-6 d-flex justify-content-center mb-4">
            <div class="card border-0 shadow-lg w-30rem">
              <div class="card-body ">

                <!--Botão do questionario-->
                <div class="d-grid col-12 text-start me-5 mb-4">
                  <button class="btn shadow-sm btn-cinza" data-bs-toggle="modal" data-bs-target="#modalEmail">
                    <div class="row text-start ">
                      <div class="  col-10 ">
                        <div class="row">
                          <div class="col-12">
                            <p class="p-0 m-0 fw-bold ">Questionário de preferências de serviço (opcional)</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-2 align-self-center text-end">
                        <i class="bi bi-chevron-right fs-3 "></i>
                      </div>
                    </div>
                  </button>
                </div>

                <!--Notificações-->

                <div class="row">
                  <div class="col-12 text-center mb-1">
                    <h5 class="p-0 m-0 fs-6 azul-senac">Caso deixe ligado a seguinte opção, você receberá notificações em até 48 horas do dia marcado</h5>
                  </div>
                </div>

                <div class="d-grid col-12 text-start me-5 mb-4">
                  <div class="shadow-sm bg-cinza py-3 px-3">
                    <div class="row text-start ">
                      <div class="  col-10 align-self-center">
                        <p class="p-0 m-0 fw-bold ">Aceitar receber notificações por email ou telefone</p>
                      </div>
                      <div class="col-2 align-self-center">
                        <div class="form-check form-switch d-flex justify-content-end ">
                          <input class="form-check-input fs-3 text-end" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Cancelar Agendamento-->

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
      <!-- modais -->
      <!-- modal alterar email -->
      <div class="modal fade" id="modalEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="">
                <div class="row">

                  <h5 class="card-title laranja-senac fw-bold d-flex justify-content-center fs-2">Preferências de serviço</h5>

                  <p class="card-text">Você possui algum tipo de alergia a algum produto de beleza?</p>
                  <div class="mb-3 form-check">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">sim</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2" checked>
                      <label class="form-check-label" for="flexRadioDefault2">não</label>
                    </div>
                    <div class="mb-3 mt-2 col-12 col-md-7">
                      <label for="exampleFormControlTextarea1" class="form-label">Quais tipos de produtos? (Máximo de 300 caracteres)</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="300"></textarea>
                    </div>

                  </div>

                  <p class="card-text">Você possui algum tipo de preferência de como seu atendimento vai ser realizado?</p>
                  <div class="mb-3 form-check">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault3">
                      <label class="form-check-label" for="flexRadioDefault3">sim</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault4" checked>
                      <label class="form-check-label" for="flexRadioDefault4">não</label>
                    </div>
                    <div class="mb-3 mt-2 col-12 col-md-7">
                      <label for="exampleFormControlTextarea2" class="form-label">Quais tipos de preferências? (Máximo de 300 caracteres)</label>
                      <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" maxlength="300"></textarea>
                    </div>
                  </div>
                </div>
                <div class="mx-4 d-flex justify-content-end">
                  <button class=" btn btn-azul-senac text-light" type="submit">Enviar</button>
                </div>
              </form>

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