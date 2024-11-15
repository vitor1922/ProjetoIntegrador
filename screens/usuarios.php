<?php

include('../constantes.php');
include_once("../data/conexao.php");

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado = $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

if ($perfil == 'professor') {
    $estilo = "badge rounded-circle bg-success";
} elseif ($perfil == 'aluno') {
    $estilo = "badge rounded-circle bg-primary";
} elseif ($perfil == 'cliente') {
    $estilo = "badge rounded-circle bg-warning";
} elseif ($perfil == 'admin') {
    $estilo = "badge rounded-circle bg-danger";
}

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

$searchUser = $_POST['searchUser'] ?? "";
$searchResults = [];
$defaultResults = [];

if ($searchUser) {
    $search = "SELECT nome, cpf, perfil FROM usuario WHERE nome REGEXP :searchUser";
    $select = $conexao->prepare($search);
    $select->bindParam(':searchUser', $searchUser);

    if ($select->execute()) {
        $searchResults = $select->fetchAll(PDO::FETCH_ASSOC);
    }
}

$defaultQuery = "SELECT nome, cpf, perfil FROM usuario";
$defaultStmt = $conexao->prepare($defaultQuery);

if ($defaultStmt->execute()) {
    $defaultResults = $defaultStmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Usuários</title>
    <meta name="author" content="Vitor Baggio">
</head>

<body>

    <?php include_once("./header.php"); ?>

    <main>
        <div class="container mt-3">
            <h1 class="text-center laranja-senac">Área do Serviço</h1>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col text-end">
                    <a href="#"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder azul-senac">Usuários</p>
                </div>
                <div class="col text-start">
                    <a href="#"><i class="bi-chevron-right"></i></a>
                </div>
            </div>
            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col d-flex justify-content-center align-items-center">
                        <form method="POST" action="">
                            <input type="text" name="searchUser" class="text-center rounded" placeholder="Pesquisar">
                        </form>
                    </div>
                    <div class="col d-flex justify-content-end flex-column align-items-center">
                        <div class="col"></div>
                        <div class="col">
                            <p><span class="badge rounded-circle bg-danger">&nbsp;</span><strong class="text-danger">Ademir</strong></p>
                            <p><span class="badge rounded-circle bg-success">&nbsp;</span><strong class="text-success">Professor</strong></p>
                            <p><span class="badge rounded-circle bg-primary">&nbsp;</span><strong class="text-primary">Aluno</strong></p>
                            <p><span class="badge rounded-circle bg-warning">&nbsp;</span><strong class="text-warning">Usuário</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($searchResults)): ?>
            <div class="container mt-3">
                <h2>Resultados</h2>
                <?php foreach ($searchResults as $result): ?>
                    <?php
                    $badgeClass = match ($result['perfil']) {
                        'professor' => "badge rounded-circle bg-success",
                        'aluno' => "badge rounded-circle bg-primary",
                        'cliente' => "badge rounded-circle bg-warning",
                        'admin' => "badge rounded-circle bg-danger",
                        default => "badge rounded-circle bg-secondary",
                    };
                    ?>
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0"><i class="bi-person-circle"></i> <?= htmlspecialchars($result["nome"]) . " • " . htmlspecialchars($result["cpf"]) ?></p>
                            <span class="<?= $badgeClass ?>">&nbsp;</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="container mt-3">
            <h2>Usuários</h2>
            <?php foreach ($defaultResults as $result): ?>
                <?php
                
                $badgeClass = match ($result['perfil']) {
                    'professor' => "badge rounded-circle bg-success",
                    'aluno' => "badge rounded-circle bg-primary",
                    'cliente' => "badge rounded-circle bg-warning",
                    'admin' => "badge rounded-circle bg-danger",
                    default => "badge rounded-circle bg-secondary",
                };
                ?>
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0"><i class="bi-person-circle"></i> <?= htmlspecialchars($result["nome"]) . " • " . htmlspecialchars($result["cpf"]) ?></p>
                        <span class="<?= $badgeClass ?>">&nbsp;</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
