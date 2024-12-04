<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

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
                        <button class="btn border fw-bold azul-senac me-5">Editar</button>
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
                        <div class="d-flex align-items-center justify-content-center offset-2 col-8">
                            <h3 class="text-center fs-4">Horários</h3>
                        </div>
                        <div class="col-1">
                            <button class=" btn "><i class="bi bi-plus-square-fill fs-3 azul-senac "></i></button>
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
                <div class="shadow-sm border  py-3 ">
                    <div class="row">
                        <div class=" offset-1 d-grid align-items-center col-4  ">
                            <input class="d-inline rounded-pill text-center py-2" type="text " placeholder="Pesquisar">

                        </div>
                        <div class="col-1 d-flex align-items-end">
                            <button class="btn "><i class="bi bi-plus-square-fill fs-3 azul-senac "></i></button>
                        </div>
                    </div>


                </div>
                <?php foreach ($turmas as $turma) {?>
                    <?php 
                    $numeroDeAlunos = 0;
                        foreach($alunos as $aluno){
                            if (in_array($turma['id_turma'], $aluno)){
                            $numeroDeAlunos += 1;
                            }
                        }
                        ?>
                    
                    <a href="">
                        <div class=" text-center border py-2 text-secondary">
                            <div class="col-12 "> idTurma:<?=$turma["numero_da_turma"]?> • <?=$curso["nome_do_curso"]?> • <?=$numeroDeAlunos?> Alunos</div>
                        </div>
                    </a>
                <?php } ?>

            </div>
        </main>
    </div>
    <?php include("./footer.php") ?>


    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>