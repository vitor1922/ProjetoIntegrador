<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;

$sql_turma = "SELECT t.numero_da_turma as numeroTurma, u.nome as nomeInstrutor, a.data  FROM agendamento a
INNER JOIN turma t
ON a.id_turma = t.id_turma
INNER JOIN alunos al
ON a.id_aluno = al.id_aluno
INNER JOIN usuario u
ON al.id_aluno = u.id_usuario
-- INNER JOIN agenda ag
-- ON a.data = ag.hora
WHERE a.id_usuario = 5
ORDER BY t.numero_da_turma DESC";
$select = $conexao->prepare($sql_turma);
// $select->bindParam(':id_usuario', $id_usuario);

if ($select->execute()) {
    $desc = $select->fetch(PDO::FETCH_ASSOC);
}

// var_dump($desc);
// die;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Horários - Instrutor</title>
    <meta name="author" content="Vitor Baggio">
</head>

<body>

    <?php
    include_once("./header.php");
    ?>

    <main>
        <div class="container mt-3">
            <h1 class="text-center laranja-senac">Área do Instrutor</h1>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col text-end">
                    <!-- colocar paginacao aqui -->
                    <a href="#"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder azul-senac">Agendamentos</p>
                </div>
                <div class="col text-start">
                    <a href="#"><i class="bi bi-chevron-right"></i></a>
                    <!-- e aqui -->
                </div>
            </div>
            <div class="mt-4">
                <strong>Ordenar por:</st>
                    <button class="btn btn-light dropdown-toggle" type="button" id="filterDropdown"
                        data-bs-toggle="dropdown">
                        Por Turma
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <button data-bs-toggle="dropdown">Mais Novo </button>
                    
                        <li><a class="dropdown-item" href="/?filtro=por-turma">Por Turma</a></li>
                    </ul>
            </div>

        </div>

        <div class="container mt-4">
            <div class="card p-3">
                <div class="row mb-2">
                    <div class="col">
                        <p><strong>Horário:</strong> 23H30</p>
                        <p><i class="bi bi-person-circle"></i><strong>Nome:</strong><br> Juanito da Peste</p>
                        <i class="bi bi-person-circle"></i><strong>Aluno:</strong><br> Thalles Gordo</p>
                    </div>
                    <div class="col">
                        <p><strong>Data:</strong> 08-11-2024</p>
                        <p><strong>Serviço:</strong><br>Corte de Cabelo</p>
                        <p><strong>Turma:</strong><br>1234</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="card p-3">
                <div class="row mb-2">
                    <div class="col">
                        <i class="bi bi-person-circle"></i><strong>Responsável:</strong> <?= $desc["nomeInstrutor"]?></p>
                    </div>
                    <div class="col">
                        <p><strong>Data:</strong> <?= $desc["data"]?></p>
                    </div>
                    <div class="col">
                    <p><strong>Turma:</strong> <?= $desc["numeroTurma"]?></p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php
    include_once("./footer.php");
    ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>