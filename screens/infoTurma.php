<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
$turmaId = $_GET["id"];
$perfilMensagem = $_SESSION["perfil_mensagem"] ?? NULL;

$sqlTurma = "SELECT * FROM turma WHERE id_turma = :id_turma";
$selectTurma = $conexao->prepare($sqlTurma);
$selectTurma->bindParam(":id_turma", $turmaId);
if ($selectTurma->execute()) {
  $turma = $selectTurma->fetch(PDO::FETCH_ASSOC);
}

$sqlCurso = "SELECT * FROM curso WHERE id_curso = :id_curso";
$selectCurso = $conexao->prepare($sqlCurso);
$selectCurso->bindParam(":id_curso", $turma["id_curso"]);
if ($selectCurso->execute()) {

  $curso = $selectCurso->fetch(PDO::FETCH_ASSOC);
}
$sqlAlunos = "SELECT u.*, a.id_aluno FROM alunos a INNER JOIN usuario u ON u.id_usuario = a.id_usuario WHERE a.id_turma = :id_turma";
$selectAlunos = $conexao->prepare($sqlAlunos);
$selectAlunos->bindParam(":id_turma", $turma["id_turma"]);
if ($selectAlunos->execute()) {

  $alunos = $selectAlunos->fetchAll(PDO::FETCH_ASSOC);
}
// echo("<pre>");
// var_dump(count($alunos));
//  die;

unset($conexao);


if($_SERVER["HTTP_HOST"] == BASE_URL . ("screens/infoTurma?id=") . $turmaId ){
  $paginaAnterior = BASE_URL . "screens/gerenciamentoTurmas.php";
}else{
  $paginaAnterior = BASE_URL . "screens/gerenciamentoTurmas.php";
}




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

<body class=" container-fluid d-flex flex-column justify-content-between">
  <div>
    <?php
    include_once("./header.php");
    ?>
    <main>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="button fs-1 mx-3">
              <a href="<?= $paginaAnterior ?>" role="button pb-5">
                <i class="bi bi-arrow-left-short azul-senac fw-bold"></i>
              </a>
            </div>
          </div>
          <div class="col-12">
            <h5 class="text-secondary fw-bold d-flex justify-content-center fs-1"><?= $turma["numero_da_turma"] ?></h5>
            <h6 class="mb-2 azul-senac d-flex justify-content-center fw-bold fs-5"><?= $curso["nome_do_curso"] ?></h6>
          </div>
        </div>
        <div class="row bg-cinza shadow d-flex justify-content-center mt-5">
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <h5 class="text-black fw-bold fs-6"><?= date("d/m/Y", strtotime($turma["data_inicio"])) ?> - <?= date("d/m/Y", strtotime($turma["data_final"])) ?></h5>
          </div>
          <div class="col-12 col-lg-6 d-flex justify-content-center">
            <h6 class="mb-2 text-black fw-bold fs-6"><?= count($alunos) ?> Alunos</h6>
          </div>
        </div>


        <div class="row mt-5 ms-4 mb-3">
          <div class="col-6">
            <input type="text" class="form-control rounded-5 fs-6  text-center " id="formGroupExampleInput" placeholder="Pesquisar">
          </div>
          <?php if ($perfil === "admin") { ?>
            <div class="col-6">
              <button class="btn btn-azul-senac text-light rounded-3 fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#modalAddAluno">Adicionar Aluno</i></button>
            </div>
          <?php } ?>
        </div>

        <?php foreach ($alunos as $aluno) { ?>
          <div class="row border-top border-bottom border-light-subtle py-2 text-secondary">
            <a href="" class="col-2 ms-3">
              <img src="../foto/<?= $aluno["foto"] ?>" class="rounded-circle img-fluid img-perfil-mini" alt="Foto de perfil do aluno">
            </a>
            <a href="" class="col-7 d-flex align-items-center text-nowrap text-secondary">
              <p class="fs-6 mb-0 me-2"><?= $aluno["nome"] ?></p>
              <p class="fs-6 mb-0 me-2">•</p>
              <p class="fs-6 mb-0"><?= $aluno["cpf"] ?></p>
            </a>
            <?php if ($perfil === "admin") { ?>

              <div class="ms-2 col-2 d-flex align-items-center">
                <button class="btn text-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalExcluirAluno<?=$aluno["id_aluno"]?>"><i class="bi bi-trash-fill"></i></button>
              </div>


              <!-- Modal excluir aluno -->
      <div class="modal fade" id="modalExcluirAluno<?=$aluno["id_aluno"]?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-body">
              <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="../src/logicos/excluirAluno.php" method="POST">
                <div class="form mb-3">
                  <p class="fs-3 fw-bold text-center text-danger">EXCLUIR ALUNO: </p>
                  <p class="fs-6 fw-bold text-center"><?=$aluno["nome"]?></p>
                  <input type="cpf" class="form-control py-0" name="txtAluno" value="<?= $aluno["id_aluno"] ?>" hidden>
                  <input type="cpf" class="form-control py-0" name="txtIdTurma" value="<?= $turmaId ?>" hidden>
                  <label for="cpfDoAlunoInput"></label>
                </div>
                <div class="mb-3 d-flex justify-content-center">
                  <button class="btn btn-danger text-white fw-bold px-5" type="submit">EXCLUIR</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

            <?php } ?>

          </div>
        <?php } ?>
      </div>


      <!-- Modal adicionar aluno-->
      <div class="modal fade" id="modalAddAluno" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-body">
              <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="../src/logicos/adicionarAluno.php" method="POST">
                <div class="form mb-3">
                  <p class="fs-6 fw-bold">CPF do Aluno</p>
                  <input type="cpf" class="form-control py-2" name="txtCpf" placeholder="CPF do Aluno" required>
                  <input type="cpf" class="form-control py-0" name="txtIdTurma" value="<?= $turmaId ?>" hidden>
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
      
      <!-- modal alerta mensagem -->
      <?php if (isset($mensagem)) { ?>


        <div class="modal fade " id="mensagem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  ">
            <div class="modal-content <?= $perfilMensagem ?>">
              <div class="modal-body ">
                <?= $mensagem ?>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
  <?php
  include_once("./footer.php");
  ?>
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../src/js/alert.js"></script>
</body>

</html>