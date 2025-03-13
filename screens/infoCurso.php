<!--infoCurso.php-->
 
 
 
<?php
 
 
 
include_once("../constantes.php");
include_once('../data/conexao.php');
 
session_start();
 
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
 
if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
} elseif ($perfil !== "professor") {
    if ($perfil !== "admin") {
        header("Location: " . BASE_URL . "index.php");
    }
}
 
$cursoId = $_GET["id"];
 
$sqlCursos = "SELECT * FROM curso WHERE id_curso = :id_curso";
$selectCursos = $conexao->prepare($sqlCursos);
$selectCursos->bindParam(":id_curso", $cursoId);
if ($selectCursos->execute()) {
    $curso = $selectCursos->fetch(PDO::FETCH_ASSOC);
}
$sqlTurmas = "SELECT * FROM turma WHERE id_curso = :id_curso";
$selectTurmas = $conexao->prepare($sqlTurmas);
$selectTurmas->bindParam(":id_curso", $cursoId);
if ($selectTurmas->execute()) {
 
    $turmas = $selectTurmas->fetchAll(PDO::FETCH_ASSOC);
}
$sqlHorarios = "SELECT * FROM agenda WHERE id_curso = :id_curso";
$selectHorarios = $conexao->prepare("$sqlHorarios");
$selectHorarios->bindParam(":id_curso", $cursoId);
if ($selectHorarios->execute()) {
    $horarios = $selectHorarios->fetchAll(PDO::FETCH_ASSOC);
}
 
$cargo = "aluno";
$sqlAlunos = "SELECT * FROM alunos";
$selectAlunos = $conexao->prepare($sqlAlunos);
if ($selectAlunos->execute()) {
    $alunos = $selectAlunos->fetchAll(PDO::FETCH_ASSOC);
}
$prof = "professor";
$sqlProfessores = "SELECT * FROM usuario WHERE perfil = :id_perfil ORDER BY nome ASC";
$selectProfessores = $conexao->prepare("$sqlProfessores");
$selectProfessores->bindParam(":id_perfil", $prof);
if ($selectProfessores->execute()) {
    $professores = $selectProfessores->fetchAll(PDO::FETCH_ASSOC);
}
 
// echo("<pre>");
//  var_dump($turmas);
//  die;
 
unset($conexao);
$paginaAnterior = "gerenciamentoCursos.php";
 
?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Maxwel">
    <title>Document</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
 
<body class="container-fluid d-flex flex-column justify-content-between">
 
 
 
 
 
    <div>
        <?php
        include_once("./header.php");
        ?>
 
        <main class="">
            <div class="container-fluid">
            
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        
                        <button class="btn border fw-bold azul-senac me-5 mt-3" data-bs-toggle="modal" data-bs-target="#modalEditarCurso">Editar</i></button>
                    </div>
                </div>
                <div class="row ">
                    <div class="col text-center fw-bold fs-1 text-secondary"> <?= $curso["nome_do_curso"] ?> </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img class="img-130" src="../foto/<?= $curso['imagem'] ?>" alt="">
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                <a class="text-center" href="<?=$curso["url"]?>">link do curso</a>    
                </div>
                <div class=" shadow-sm border mt-3 pb-2 pt-2 ">
                    <div class="row ">
                        <div class="d-flex align-items-center justify-content-center offset-3 col-6">
                            <h3 class="text-center fs-4">Horários de Atendimento</h3>
                        </div>
                    </div>
                    <?php foreach ($horarios as $horario) { ?>
                        <?php $data = date('d/m/Y', strtotime($horario["data"])) ?>
                        <div class="row">
                            <div class="offset-sm-4 offset-2 col-sm-3 col-7 d-flex justify-content-center align-items-center">
                                <p class="text-center my-0 py-0"><?= $data ?> - <?= date("H:i", strtotime($horario["hora"])) ?> - 0/<?= $horario["vagas"] ?> vagas</p>
                            </div>
                            <div class=" col-1 d-flex justify-content-start">
                                <button class=" btn" data-bs-toggle="modal" data-bs-target="#modalExcluirHorario<?=$horario["id_agenda"]?>"><i class="bi bi-ban text-danger"></i></button>
                            </div>
                        </div>
                              <!-- Modal excluir Horario-->
              <div class="modal fade" id="modalExcluirHorario<?=$horario["id_agenda"]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="../src/logicos/deleteHorario.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                    <p class="text-center">Tem certeza que deseja excluir o horário?</strong>?</p>
                      <input type="text" class="form-control" name="idHorario" value="<?=$horario["id_agenda"]?>" hidden required>
                      <input type="text" class="form-control" name="idCurso" value="<?=$curso["id_curso"]?>" hidden required>
                    </div>
 
                    <div class="mb-3 d-flex justify-content-center">
                      <button class="btn  btn-danger  text-white fw-bold px-5" type="submit">Deletar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>







                    <?php } ?>
                </div>
                <div class="shadow-sm border py-3 ">
                    <div class="row">
                        <div class=" offset-1 d-grid align-items-center col-4  ">
                            <input class="d-inline rounded-pill text-center py-2" type="text " placeholder="Pesquisar">
 
                        </div>
                        <div class="col-1 offset-sm-0 offset-3 d-flex align-items-end">
                            <button class="btn btn-azul-senac text-white fw-bold " data-bs-toggle="modal" data-bs-target="#modalAdicionarTurma">Adicionar Turma</i></button>
                        </div>
 
                        <div class="col-sm-6 d-grid align-items-center">
                            <div class="row">
                                <div class=" offset-1 col-1 p-0 ponto d-block rounded-circle bg-azul-senac align-self-center"></div>
                                <div class="col-9 azul-senac">Em Andamento</div>
                            </div>
                            <div class="row">
                                <div class=" offset-1 col-1 p-0 bg-danger ponto d-block rounded-circle align-self-center"></div>
                                <div class="col-9 text-danger">Concluída</div>
                            </div>
                        </div>
                    </div>
                </div>
 
 
 
 
 
                <?php foreach ($turmas as $turma) { ?>
                    <?php
                    $numeroDeAlunos = 0;
                    foreach ($alunos as $aluno) {
                        if ($turma['id_turma'] === $aluno["id_turma"]) {
                            $numeroDeAlunos += 1;
                        }
                    }
                    $dataAtual = date("Y-m-d");
                    if ($turma["data_final"] > $dataAtual) {
                        $andamentoCurso = "bg-azul-senac";
                    } else {
                        $andamentoCurso = "bg-danger";
                    }
                    ?>
 
                    <a href="infoTurma.php?id=<?= $turma["id_turma"] ?>">
                        <div class=" text-center border py-2 text-secondary">
 
                            <div class="row d-flex align-content-center">
                                <div class=" offset-1 col-9 "> idTurma:<?= $turma["numero_da_turma"] ?> • <?= $curso["nome_do_curso"] ?> • <?= $numeroDeAlunos ?> Alunos ---- data final<?=$turma["data_final"] ?> ----- data atual <?=$dataAtual?></div>
                                <div class=" col-1 p-0 <?= $andamentoCurso ?> ponto d-block rounded-circle align-self-center"></div>
 
                            </div>
                        </div>
                    </a>

                <?php } ?>
 
                <!-- MODAL EDITAR CURSO -->
                <div class="modal fade" id="modalEditarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/editarCurso.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Alterar Nome do Curso</label>
                                        <input type="text" class="form-control" name="txtCurso" >
                                        <input type="text" class="form-control" name="cursoId" value="<?=$_GET["id"]?>" hidden>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" title="busque a url do curso no site oficial do senac">Alterar URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="txtURL" >
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Alterar Imagem do Curso</label>
                                        <input type="file" name="imgCurso" class="form-control" accept="image/png, image/jpeg">
                                    </div>
 
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
 
                <!-- MODAL ADICIONAR TURMA -->
                <div class="modal fade" id="modalAdicionarTurma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/adicionarTurma.php" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Professor Responsável</label>
 
                                        <select type="text" class="form-control" name="txtProfessor" required>
                                            <option value="" disabled selected>Selecione um professor</option>
                                            <?php foreach ($professores as $professor) { ?>
                                                <option value="<?= $professor["id_usuario"] ?>"><?= $professor["nome"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID da Turma</label>
                                        <input type="text" class="form-control" name="txtIdTurma" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Data de Início</label>
                                        <input type="date" class="form-control" name="txtDataInicio" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Data do Fim</label>
                                        <input type="date" class="form-control" name="txtDataFim" required>
                                    </div>
                                    <input type="text" value="<?= $cursoId ?>" name="txtIdCurso" hidden>
 
 
                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
 
               
 
            </div>
        </main>
    </div>
    <?php include("./footer.php") ?>
 
 
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
 
</html>