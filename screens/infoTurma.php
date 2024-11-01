<?php

include_once("../constantes.php")

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informações da Turma</title>
  <meta name="author" content="NickTon">

  <link href="../src/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class=" vh-100 d-flex flex-column justify-content-between">
  <div>
    <?php
    include_once("./header.php");
    ?>
    <main>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="button fs-1 mx-3">
              <a href="#" role="button pb-5">
                <i class="bi bi-arrow-left-short azul-senac fw-bold"></i>
              </a>
            </div>
          </div>
          <div class="col-12">
            <h5 class="text-secondary fw-bold d-flex justify-content-center fs-1">202400004</h5>
            <h6 class="mb-2 azul-senac d-flex justify-content-center fw-bold fs-5">Nome do Curso</h6>
          </div>
        </div>
        <div class="row bg-cinza shadow d-flex justify-content-center mt-5">
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <h5 class="text-black fw-bold fs-6">dd-mm-aa - dd/mm/aa</h5>
          </div>
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <h6 class="mb-2 text-black fw-bold fs-6">13/14 Alunos</h6>
          </div>
        </div>

        <div class="row mt-5 ms-4">
          <div class="col-6">
            <input type="text" class="form-control rounded-5 fw-bold fs-6  text-center" id="formGroupExampleInput" placeholder="Pesquisar">
          </div>
          <div class="col-6">
            <button class="btn btn-azul-senac text-light rounded-3" type="submit" data-bs-toggle="modal" data-bs-target="#modalAddAluno"><i class="bi bi-plus-lg"></i></button>
          </div>
        </div>

        <div class="row border-top border-bottom border-light-subtle py-2 mt-3">
          <div class="col-2 ms-3">
            <img src="../assets/img/img_barbeiro.png" class="rounded-circle img-fluid" style="height: 2.8rem; width: 2.8rem;" alt="Foto de perfil do aluno">
          </div>
          <div class="col-7 d-flex align-items-center text-nowrap">
            <p class="fs-6 mb-0 me-2">Nome do Usuário</p>
            <p class="fs-6 mb-0 me-2">•</p>
            <p class="fs-6 mb-0">000.000.000-00</p>
          </div>
          <div class="ms-2 col-2 d-flex align-items-center">
            <button class="btn text-danger"><i class="bi bi-ban" style="text-shadow: 0 1px 1px red"></i></button>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="modalAddAluno" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-body">
              <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="">
                <div class="form-floating mb-3">
                  <p class="fs-6 fw-bold">Nome do Aluno</p>
                  <input type="text" class="form-control py-0" id="nomeDoAlunoInput" placeholder="Nome do Aluno">
                  <label for="nomeDoAlunoInput"></label>
                </div>
                <div class="form-floating mb-3">
                  <p class="fs-6 fw-bold">CPF do Aluno</p>
                  <input type="cpf" class="form-control py-0" id="cpfDoAlunoInput" placeholder="CPF do Aluno">
                  <label for="cpfDoAlunoInput"></label>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                  <button class="btn btn-azul-senac text-white fw-bold px-5" type="submit">Adicionar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
  <?php
  include_once("./footer.php");
  ?>
  <script src="../src/bootstrap/js/bootstrap.js"></script>
</body>

</html>