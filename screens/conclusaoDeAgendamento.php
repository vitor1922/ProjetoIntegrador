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

          <!--Resumo do agendamento-->
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <div class="card shadow-lg">
              <img src="../assets/img/img_mulher_lavando_cabelo.png" class="card-img-top img-fluid p-3" alt="...">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <h5 class="card-title fs-6 text-start">Lavagem de cabelo</h5>
                  </div>
                  <div class="col-6">
                    <h5 class="card-title fs-6 text-end">00/00/0000</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Opções gerais-->
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <div class="card border-0 shadow-lg">
              <div class="card-body ">

                <!--Botão do questionario-->
                <div class="d-grid col-12 text-start me-5 mb-3">
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
                  <div class="col-12 text-center">
                    <h5 class="p-0 m-0 fs-6 azul-senac">Caso deixe ligado a seguinte opção, você receberá notificações em até 48 horas do dia marcado</h5>
                  </div>
                </div>

                <div class="d-grid col-12 text-start me-5 mb-3">
                  <button class="btn shadow-sm btn-cinza ">
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
                  </button>
                </div>

                <!--Cancelar Agendamento-->

                <div class="row">
                  <div class="col-12 text-center">
                    <h5 class="p-0 m-0 fs-6 text-danger">Caso deixe ligado a seguinte opção, você receberá notificações em até 48 horas do dia marcado</h5>
                  </div>
                </div>

                <div class="mb-3  d-flex justify-content-center">
                  <button class="btn  btn-danger  text-white fw-bold px-5" type="submit">Confirmar</button>
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