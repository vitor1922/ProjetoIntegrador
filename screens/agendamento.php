<?php

session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ./signUp.php");
    exit();
}


include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}




$sqlVerificaVagas = "
    SELECT 
        (1 - COUNT(ag.id_agendamento)) AS vagas_restantes -- 10 é o número fixo de vagas
    FROM agenda a
    LEFT JOIN agendamento ag ON a.id_agenda = ag.id_agenda
    WHERE a.id_agenda = :id_agenda
    GROUP BY a.id_agenda
";



$sqlAgenda = "SELECT * FROM agenda";
$selectAgenda = $conexao->prepare($sqlAgenda);
$selectAgenda->execute();
$todosHorarios = $selectAgenda->fetchAll(PDO::FETCH_ASSOC);

$sqlCurso = "SELECT id_curso, nome_do_curso, imagem FROM curso";
$select = $conexao->prepare($sqlCurso);

if ($select->execute()) {
    $cursos = $select->fetchAll(PDO::FETCH_ASSOC);
}

$horariosPorCurso = [];
foreach ($todosHorarios as $hora) {
    $idCurso = $hora['id_curso'];
    $horariosPorCurso[$idCurso][] = $hora;
}


unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar agendamento</title>
    <meta name="author" content="Daniel">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css" class="">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="container-fluid">
    <?php
    include("./header.php");
    ?>

    <main class="pb-5 mb-5">

    


    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>" class="bi bi-arrow-left fs-3 m-5"></i></a>
        <?php if (isset($mensagem)): ?>
            <div class="container">
                <div class="alert alert-<?= $mensagem['tipo'] ?> alert-dismissible fade show" role="alert">
                    <?= $mensagem['texto'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-md-12 col-14 text-center">
                    <h2 class="laranja-senac fw-bold pb-5">Serviços disponíveis</h2>
                </div>
            </div>
            <div class="row justify-content-center pb-5 mb-5">
                <?php foreach ($cursos as $curso): ?>
                    <div class="col-lg-3 col-md-6 pb-3 ps-4 d-flex justify-content-center marginAgendamento">
                        <div class="card card-imagem shadow-sm w-23rem border-0">
                            <img src="../foto/<?= htmlspecialchars($curso['imagem']) ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-lg-12 col-xxl-7">
                                        <h5 class="card-title"><?= htmlspecialchars($curso['nome_do_curso']) ?></h5>
                                    </div>
                                    <div class="offset-2 col-3 offset-xxl-0 ps-xxl-5 p-0">
                                        <p class="d-inline-flex gap-1">

                                            <button
                                                class="btn btn-azul-senac text-light"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapseCurso<?= $curso['id_curso'] ?>"
                                                aria-expanded="false"
                                                aria-controls="collapseCurso<?= $curso['id_curso'] ?>"
                                                value="<?= $curso['id_curso'] ?>">

                                                Selecionar
                                            </button>
                                        </p>
                                    </div>
                                </div>
                                <form action="../src/logicos/processar_agendamento.php" method="POST">

                                    <div
                                        class="collapse"
                                        id="collapseCurso<?= $curso['id_curso'] ?>">
                                        <div class="card card-body start-0 position-absolute w-100">
                                            <select class="form-select bg-warning-subtle" aria-label="Default select example" name="id_agenda">
                                                <option selected>Selecionar Horario</option>
                                                <?php
                                                
                                                $idCursoAtual = $curso['id_curso'];
                                                $horariosDoCurso = $horariosPorCurso[$idCursoAtual] ?? [];
                                                ?>
                                                <?php foreach ($horariosDoCurso as $hora): ?>
                                                    <?php $dataFormatada = (new DateTime($hora['data']))->format('d/m/Y'); ?>
                                                    <option value="<?= $hora['id_agenda'] ?>">
                                                        <?= $hora['hora'] ?> - <?= $dataFormatada ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="position-relative mt-5">
                                                <div class="position-absolute bottom-0 end-0 mt-5">
                                                    <button type="submit" class="btn btn-azul-senac text-light">
                                                        Agendar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach;  
                ?>
            </div>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>
    
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>