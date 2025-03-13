<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
} elseif ($perfil !== "professor") {
    if ($perfil !== "admin") {
        header("Location: " . BASE_URL . "index.php");
    }
}

$sqlCursos = "SELECT * FROM curso ORDER BY nome_do_curso";
$selectCursos = $conexao->prepare($sqlCursos);
if ($selectCursos->execute()) {
    $cursos = $selectCursos->fetchAll(PDO::FETCH_ASSOC);
}
$sqlTurmas = "SELECT t.*  FROM turma t INNER JOIN curso c ON t.id_curso = c.id_curso ORDER BY c.nome_do_curso";
$selectTurmas = $conexao->prepare($sqlTurmas);
if ($selectTurmas->execute()) {
    $turmas = $selectTurmas->fetchAll(PDO::FETCH_ASSOC);
}
$sqlAlunos = "SELECT * FROM alunos";
$selectAlunos = $conexao->prepare($sqlAlunos);
if ($selectAlunos->execute()) {
    $alunos = $selectAlunos->fetchAll(PDO::FETCH_ASSOC);
}

$prof = "professor";
$sqlProfessores = "SELECT * FROM usuario WHERE perfil = :id_curso ORDER BY nome ASC";
$selectProfessores = $conexao->prepare("$sqlProfessores");
$selectProfessores->bindParam(":id_curso", $prof);
if ($selectProfessores->execute()) {
    $professores = $selectProfessores->fetchAll(PDO::FETCH_ASSOC);
}
$search = $_GET['search'] ?? '';

$query = "SELECT * FROM turma WHERE 1=1";
$params = [];

if ($search) {
    $query .= " AND numero_da_turma LIKE :search";
    $params['search'] = "%$search%";
}

$query .= " ORDER BY numero_da_turma";
$stmt = $conexao->prepare($query);
$stmt->execute($params);
$turmas = $stmt->fetchAll(PDO::FETCH_ASSOC);
unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title></title>
</head>

<body class="container-fluid d-flex flex-column justify-content-between">
    
        <?php
        include_once("./header.php");
        ?>

        <main>
            <div class="container-fluid mt-3">
            
                <h1 class="text-center">Área do Serviço</h1>
                <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                    <div class="col text-end">
                        <a href="#"><i class="bi bi-chevron-left"></i></a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-7 text-center">
                        <p class="mt-3 fw-bolder fs-4 azul-senac">Gerenciamento</p>
                    </div>
                    <div class="col text-start">
                        <a href="#"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
                
                <div class="row mt-5 d-flex justify-content-center ">
                <a href="./gerenciamentoCursos.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">CURSOS</button>
                    </a>
                    <a href="./gerenciamentoTurmas.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 fw-bold p-0 ">
                        <button class="btn btn-azul-senac text-white border-dark-subtle fs-7 fw-bold" type="button">TURMAS</button>
                    </a>
                    
                    <a href="./gerenciamentoProfessores.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">PROFESSORES</button>
                    </a>
                </div>


                </div>
                <form method="GET" class="mb-4">
                    <div class="row mb-2">
                        <div class="col-4 d-flex align-items-center">
                            <input type="text" name="search" class="col-12 text-start rounded-4 fs-7 text-black-50 text-center h-50 py-3" placeholder="Pesquisar..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <?php if($perfil === "admin"){?>
                            <div class="col-md-2 pt-2">
                            <button type="button" class=" ms-3 btn btn-primary btn-azul-senac" data-bs-toggle="modal" data-bs-target="#modalCadastrarTurma">Adicionar Turma</button>
                            </div>
                        <?php }?>
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
                </form>
                <?php foreach ($turmas as $turma): ?>
                    <?php $numeroAlunos = 0; ?>
                    <?php foreach ($cursos as $curso) { ?>
                        <?php if ($turma["id_curso"] === $curso["id_curso"]) { ?>
                            <?php foreach ($alunos as $aluno) { ?>
                                <?php if ($turma["id_turma"] === $aluno["id_turma"]) { ?>
                                    <?php $numeroAlunos += 1; ?>
                                <?php } ?>
                            <?php } ?>
                            <?php
                            $dataAtual = date("Y-m-d");
                            if ($turma["data_final"] > $dataAtual) {
                                $andamentoCurso = "bg-azul-senac";
                            } else {
                                $andamentoCurso = "bg-danger";
                            }

                            ?>
                            <a href="./infoTurma.php?id=<?= $turma["id_turma"] ?>">
                                <div class=" text-center border py-3 text-secondary">

                                    <div class="row d-flex align-content-center">
                                        <div class=" offset-1 col-9 "> idTurma:<?= $turma["numero_da_turma"] ?> • <?= $curso["nome_do_curso"] ?> • <?= $numeroAlunos ?> Alunos</div>
                                        <div class=" col-1 p-0 <?= $andamentoCurso ?> ponto d-block rounded-circle align-self-center"></div>

                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                    <?php endforeach; ?>


                <!-- MODAL ADICIONAR CURSO -->
                <div class="modal fade" id="modalCadastrarTurma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/adicionarTurma.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nome do Curso</label>
                                        <select class="form-control" name="txtIdCurso" required>
                                        <option value="" disabled selected>Selecio o curso</option>
                                            <?php foreach($cursos as $curso){?>
                                            <option value="<?=$curso["id_curso"]?>"> <?= $curso["nome_do_curso"]?></option>
                                            <?php }?>
                                        </select>
                                    </div>

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
    
    <?php
    include_once("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>