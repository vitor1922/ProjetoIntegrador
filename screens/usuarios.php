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
$filter = $_GET['filter'] ?? null;

if ($searchUser) {
    $search = "SELECT * FROM usuario WHERE nome REGEXP :searchUser";
    $select = $conexao->prepare($search);
    $select->bindParam(':searchUser', $searchUser);

    if ($select->execute()) {
        $searchResults = $select->fetchAll(PDO::FETCH_ASSOC);
    }
}

$defaultQuery = "SELECT * FROM usuario";
if ($filter) {
    $defaultQuery .= " WHERE perfil = :filter";
}
$defaultStmt = $conexao->prepare($defaultQuery);

if ($filter) {
    $defaultStmt->bindParam(':filter', $filter);
}

if ($defaultStmt->execute()) {
    $defaultResults = $defaultStmt->fetchAll(PDO::FETCH_ASSOC);
}

function formatCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
}

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
                            <div class="d-flex flex-column align-items-center">
                                <input type="text" name="searchUser" class="text-center rounded mb-2"
                                    placeholder="Pesquisar">
                                <a href="?" class="text-decoration-none">Limpar Filtros</a>
                            </div>
                        </form>
                    </div>

                    <div class="col d-flex justify-content-center flex-column align-items-center">
                        <div class="col"></div>
                        <div class="col">
                            <p>
                                <a href="?filter=admin" class="badge rounded-circle bg-danger text-decoration-none">&nbsp;</a>
                                <strong class="text-danger">Admin</strong>
                            </p>
                            <p>
                                <a href="?filter=professor" class="badge rounded-circle bg-success text-decoration-none">&nbsp;</a>
                                <strong class="text-success">Professor</strong>
                            </p>
                            <p>
                                <a href="?filter=aluno" class="badge rounded-circle bg-primary text-decoration-none">&nbsp;</a>
                                <strong class="text-primary">Aluno</strong>
                            </p>
                            <p>
                                <a href="?filter=cliente" class="badge rounded-circle bg-warning text-decoration-none">&nbsp;</a>
                                <strong class="text-warning">Usuário</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($searchUser && empty($searchResults)): ?>
            <div class="container mt-3 d-flex justify-content-center">
                <div class="alert alert-warning" role="alert">
                    Nenhum usuário encontrado com o nome "<?= htmlspecialchars($searchUser) ?>".
                </div>
            </div>
        <?php endif; ?>

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
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if (!empty($result['foto']) && file_exists("../foto/" . $result['foto'])): ?>
                                    <img src="../foto/<?= htmlspecialchars($result['foto']) ?>" alt="Foto de <?= htmlspecialchars($result['nome']) ?>" class="rounded-circle" width="50" height="50">
                                <?php else: ?>
                                    <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                                <?php endif; ?>
                                <p class="mb-0 ms-3">
                                    <?= htmlspecialchars($result["nome"]) . " • " . htmlspecialchars(formatCPF($result["cpf"])) ?>
                                </p>
                            </div>
                            <span class="<?= $badgeClass ?>">&nbsp;</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="container mt-3">
            <h2></h2>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <?php if (!empty($result['foto']) && file_exists("../foto/" . $result['foto'])): ?>
                                    <img src="../foto/<?= htmlspecialchars($result['foto']) ?>" alt="Foto de <?= htmlspecialchars($result['nome']) ?>" class="rounded-circle" width="50" height="50">
                                <?php else: ?>
                                    <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                                <?php endif; ?>
                                <p class="mb-0 ms-3">
                                    <?= htmlspecialchars($result["nome"]) . " • " . htmlspecialchars(formatCPF($result["cpf"])) ?>
                                </p>
                            </div>
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