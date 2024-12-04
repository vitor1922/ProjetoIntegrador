<?php

include_once("../constantes.php");
include_once('../data/conexao.php');

session_start();
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_agendamento'])) {
    $idAgendamento = $_POST['id_agendamento']; // Unique identifier for the selected agendamento
    $sql_update = "UPDATE agendamento SET status = 1 WHERE id_agendamento = :id_agendamento";
    $stmt = $conexao->prepare($sql_update);
    $stmt->bindValue(':id_agendamento', $idAgendamento, PDO::PARAM_INT);
    $stmt->execute();
}

$searchUser = $_POST['searchUser'] ?? "";
$filter = $_GET['filter'] ?? null;

$searchResults = [];
$defaultResults = [];

$sql_default = "
SELECT 
    a.id_agendamento AS idAgendamento,
    t.numero_da_turma AS numeroTurma,
    u.nome AS nomeResponsavel,
    u.cpf AS cpf,
    a.status,
    a.data 
FROM 
    agendamento a
INNER JOIN 
    turma t ON a.id_turma = t.id_turma
INNER JOIN 
    usuario u ON a.id_usuario = u.id_usuario
";

$whereClauses = [];
$params = [];

if (isset($filter)) {
    $whereClauses[] = "a.status = :filter";
    $params[':filter'] = $filter;
}

if (!empty($searchUser)) {
    $whereClauses[] = "u.nome LIKE :searchUser";
    $params[':searchUser'] = '%' . $searchUser . '%';
}

if (!empty($whereClauses)) {
    $sql_default .= " WHERE " . implode(" AND ", $whereClauses);
}

$sql_default .= " ORDER BY a.data DESC";

$stmt = $conexao->prepare($sql_default);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value, PDO::PARAM_STR);
}

if ($stmt->execute()) {
    $defaultResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Horários - Instrutor</title>
    <meta name="author" content="Vitor Baggio">
</head>

<body>

    <?php include_once("./header.php"); ?>

    <main>
        <div class="container mt-3">
            <h1 class="text-center laranja-senac">Área do Instrutor</h1>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col text-end">
                    <a href="#"><i class="bi bi-chevron-left"></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder azul-senac">Agendamentos</p>
                </div>
                <div class="col text-start">
                    <a href="#"><i class="bi bi-chevron-right"></i></a>
                </div>
            </div>

            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col d-flex justify-content-center align-items-center">
                        <form method="POST" action="">
                            <div class="d-flex flex-column align-items-center">
                                <input type="text" name="searchUser" class="text-center rounded mb-2"
                                    placeholder="Pesquisar" value="<?= htmlspecialchars($searchUser) ?>">
                                <a href="?" class="text-decoration-none mt-2">Limpar Filtros</a>
                            </div>
                        </form>
                    </div>

                    <div class="col d-flex justify-content-center flex-column align-items-center">
                        <p>
                            <a href="?filter=1" class="btn btn-success rounded-circle">&nbsp;</a>
                            <strong class="text-success">Concluído</strong>
                        </p>
                        <p>
                            <a href="?filter=0" class="btn btn-danger rounded-circle">&nbsp;</a>
                            <strong class="text-danger">Pendente</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <?php if (empty($defaultResults)): ?>
                    <p class="text-center">Nenhum agendamento encontrado.</p>
                <?php else: ?>
                    <?php foreach ($defaultResults as $result): ?>
                        <?php
                        $badgeClass = $result['status'] === '1'
                            ? "badge rounded-circle bg-success"
                            : "badge rounded-circle bg-danger";
                        ?>

                        <div class="card p-3 mb-3">
                            <div class="row mb-2">
                                <div class="col-auto d-flex justify-content-start align-items-start">
                                    <p><strong>Turma:</strong><br><?= $result["numeroTurma"] ?></p>
                                </div>
                                <div class="col-auto d-flex justify-content-center align-items-center">
                                    <p><strong>Serviço:</strong><br>Corte de Cabelo</p>
                                </div>
                                <div class="col-auto d-flex justify-content-end align-items-end">
                                    <p><strong>Data:</strong><br><?= $result["data"] ?></p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-auto d-flex justify-content-start align-items-start">
                                    <i class="bi-person-circle"></i>
                                </div>
                                <div class="col-auto d-flex justify-content-center align-items-center">
                                    <?= $result["nomeResponsavel"] . " • " . $result["cpf"] ?>
                                </div>
                                <div class="col-auto d-flex justify-content-end align-items-end">
                                    <span class="<?= $badgeClass ?>">&nbsp;</span>
                                </div>
                            </div>

                            <?php if ($result['status'] === '0'): ?>
                                <form method="POST" action="">
                                    <div class="row ">
                                        <div class="col d-flex align-items-end justify-content-end">
                                        <input type="hidden" name="id_agendamento" value="<?= $result['idAgendamento'] ?>">
                                        <button type="submit" class="btn btn-primary">Concluir</button>
                                        </div>
                                    </div>
                                </form>




                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <?php include_once("./footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>