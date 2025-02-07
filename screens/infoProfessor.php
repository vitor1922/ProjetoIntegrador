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

$professorId = $_GET["id"];

$sqlTurmas = "SELECT t.*, c.nome_do_curso FROM turma t INNER JOIN curso c ON t.id_curso = c.id_curso WHERE t.id_usuario = :id_usuario";
$selectTurmas = $conexao->prepare($sqlTurmas);
$selectTurmas->bindParam(":id_usuario", $professorId);
if ($selectTurmas->execute()) {

    $turmas = $selectTurmas->fetchAll(PDO::FETCH_ASSOC);
}


$sqlProfessor = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$selectProfessor = $conexao->prepare("$sqlProfessor");
$selectProfessor->bindParam(":id_usuario", $professorId);
if ($selectProfessor->execute()) {
    $professor = $selectProfessor->fetch(PDO::FETCH_ASSOC);
}

$sqlAlunos = "SELECT u.*, a.id_aluno FROM alunos a INNER JOIN usuario u ON u.id_usuario = a.id_usuario WHERE a.id_turma = :id_turma";
$selectAlunos = $conexao->prepare($sqlAlunos);
$selectAlunos->bindParam(":id_turma", $turma["id_turma"]);
if ($selectAlunos->execute()) {

  $alunos = $selectAlunos->fetchAll(PDO::FETCH_ASSOC);
}
// echo("<pre>");
//  var_dump($turmas);
//  die;

unset($conexao);
$paginaAnterior = "gerenciamentoProfessores.php";

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

        <main class=" ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <a href="<?= $paginaAnterior ?>"><i class="bi bi-arrow-left-short fs-1 azul-senac"></i></a>
    
                    </div>
                </div>
                <div class="row ">
                    <div class="col text-center fw-bold fs-1 text-secondary"> <?= $professor["nome"] ?> </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <img class="img-130" src="../foto/<?= $professor['foto'] ?>" alt="">
                    </div>
                </div>
                
                <div class="shadow-sm border py-3 ">
                    <div class="row">
                        <div class=" offset-1 d-grid align-items-center col-4  ">
                            <input class="d-inline rounded-pill text-center py-2" type="text " placeholder="Pesquisar">

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
                                <div class=" offset-1 col-9 "> idTurma:<?= $turma["numero_da_turma"] ?> • <?= $turma["nome_do_curso"] ?> • <?= $numeroDeAlunos ?> Alunos </div>
                                <div class=" col-1 p-0 <?= $andamentoCurso ?> ponto d-block rounded-circle align-self-center"></div>

                            </div>
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