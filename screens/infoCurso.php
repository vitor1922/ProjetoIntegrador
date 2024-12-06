<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}elseif($perfil !== "professor"){
    if ($perfil !== "admin"){
        header("Location: " . BASE_URL . "index.php");
    }
}




$cursoId = $_GET["id"];

$sqlCurso = "SELECT * FROM curso WHERE id_curso = :id_curso";
$selectCurso = $conexao->prepare($sqlCurso);
$selectCurso->bindParam(":id_curso", $cursoId);
if ($selectCurso->execute()) {
    $curso = $selectCurso->fetch(PDO::FETCH_ASSOC);
}
$sqlTurmas = "SELECT * FROM turma WHERE id_curso = :id_curso";
$selectTurmas = $conexao->prepare("$sqlTurmas");
$selectTurmas->bindParam(":id_curso", $cursoId);
if ($selectTurmas->execute()) {
    $turmas = $selectTurmas->fetchAll(PDO::FETCH_ASSOC);
}

$cargo = "aluno";
$sqlAlunos = "SELECT * FROM alunos";
$selectAlunos = $conexao->prepare($sqlAlunos);
if ($selectAlunos->execute()) {
    $alunos = $selectAlunos->fetchAll(PDO::FETCH_ASSOC);
}
unset($conexao);

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

<body class="vh-100 d-flex flex-column justify-content-between">
    <div>
        <?php
        include_once("./header.php");
        ?>

        <main class=" ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="./gerenciamentoCursos.php"><i class="bi bi-arrow-left-short fs-1 azul-senac"></i></a>
                        <button class="btn border fw-bold azul-senac me-5 ">Editar</button>
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
                <div class=" shadow-sm border mt-3 pb-2 ">
                    <div class="row ">
                        <div class="d-flex align-items-center justify-content-center offset-3 col-6">
                            <h3 class="text-center fs-4">Horários</h3>
                        </div>
                        <div class="col-1">
                            <button class=" btn "><i class="bi bi-plus-square-fill fs-2 azul-senac "></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-sm-4 offset-2 col-sm-3 col-7 d-flex justify-content-center align-items-center">
                            <p class="text-center my-0 py-0">seg - 17:00 até 18:30</p>
                        </div>
                        <div class=" col-1 d-flex justify-content-start">
                            <button class=" btn"><i class="bi bi-ban text-danger"></i></button>
                        </div>
                    </div>
                </div>
                <div class="shadow-sm border py-3 ">
                    <div class="row">
                        <div class=" offset-1 d-grid align-items-center col-4  ">
                            <input class="d-inline rounded-pill text-center py-2" type="text " placeholder="Pesquisar">

                        </div>
                        <div class="col-1 offset-sm-0 offset-3 d-flex align-items-end">
                            <button class="btn " data-bs-toggle="modal" data-bs-target="#modalCadastrarTurma"><i class="bi bi-plus-square-fill fs-2 azul-senac"></i></button>
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
                        if ($turma['id_turma']=== $aluno["id_turma"]) {
                            $numeroDeAlunos += 1;
                        }
                    }
                    $dataAtual = date("y-m-d");
                    if ($turma["data_final"] <= $dataAtual) {
                        $andamentoCurso = "bg-azul-senac";
                    } else {
                        $andamentoCurso = "bg-danger";
                    }
                    ?>

                    <a href="">
                        <div class=" text-center border py-2 text-secondary">

                            <div class="row d-flex align-content-center">
                                <div class=" offset-1 col-9 "> idTurma:<?= $turma["numero_da_turma"] ?> • <?= $curso["nome_do_curso"] ?> • <?= $numeroDeAlunos ?> Alunos </div>
                                <div class=" col-1 p-0 <?= $andamentoCurso ?> ponto d-block rounded-circle align-self-center"></div>

                            </div>
                        </div>
                    </a>
                <?php } ?>



                <!-- MODAL ADICIONAR CURSO -->
                <div class="modal fade" id="modalCadastrarTurma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/adicionarTurma.php" method="POST" >
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID da Turma</label>
                                        <input type="text" class="form-control" name="txtIdTurma" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" >Data de Início</label>
                                        <input type="date" class="form-control" name="txtDataInicio" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" >Data do Fim</label>
                                        <input type="date" class="form-control" name="txtDataFim" required>
                                    </div>
                                    <input type="text" value="<?=$cursoId?>" name="txtIdCurso" hidden>
                                    

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