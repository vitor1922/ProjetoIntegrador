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

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

$searchUser = $_POST['searchUser'] ?? "";
$searchResults = [];
$defaultResults = [];
$filter = $_GET['filter'] ?? null;

if ($searchUser) {
    $search = "SELECT * FROM usuario WHERE nome REGEXP :searchUser OR cpf REGEXP :searchUser";
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

if ($filter == 0) {
    $defaultQuery = "SELECT * FROM usuario WHERE status = ':filter'";
} else if ($filter == 1) {
    $defaultQuery = "SELECT * FROM usuario WHERE status = :filter";
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['desativar_usuario'])) {
        $id_usuario = $_POST['id_usuario'];
        $stmt = $conexao->prepare("UPDATE usuario SET status = 1 WHERE id_usuario = :id_usuario"); // remover o AND status = 0
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    if (isset($_POST['reativar_usuario'])) {
        $id_usuario = $_POST['id_usuario'];
        $stmt = $conexao->prepare("UPDATE usuario SET status = 0 WHERE id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
    }

    if (isset($_POST['alterar_perfil'])) {
        if (isset($_POST['novo_perfil']) && isset($_POST['id_usuario'])) {
            $id_usuario = $_POST['id_usuario'];
            $novo_perfil = $_POST['novo_perfil'];
            $stmt = $conexao->prepare("UPDATE usuario SET perfil = :perfil WHERE id_usuario = :id_usuario");
            $stmt->bindParam(':perfil', $novo_perfil);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->execute();
        }
    }
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
            <h1 class="text-center laranja-senac">Área do ADM</h1>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col text-end">
                    <a href="./areaInstrutor.php"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder azul-senac">Usuários</p>
                </div>
                <div class="col text-start">
                    <a href="./gerenciamentoCursos.php"><i class="bi-chevron-right"></i></a>
                </div>
            </div>

            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col d-flex justify-content-center align-items-center">
                        <form method="POST" action="">
                            <div class="d-flex flex-column align-items-center">
                                <input type="text" name="searchUser" class="search-input search-inputCavera text-center rounded mb-2"
                                    placeholder="Nome/CPF">
                                <div class="d-flex flex-row align-items-center">
                                    <a href="?" class="text-decoration-none margin-right-3 me-2">Limpar</a>
                                    <button type="submit" class="btn btn-primary rounded-pill">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col d-flex justify-content-center flex-column align-items-center">
                        <div class="col"></div>
                        <div class="col">
                            <p>
                                <a href="?filter=admin" class="badge rounded-circle bg-danger text-decoration-none">&nbsp;</a>
                                <a href="?filter=admin" class=""><strong class="text-danger">Admin</strong></a>

                            </p>
                            <p>
                                <a href="?filter=aluno" class="badge rounded-circle bg-primary text-decoration-none">&nbsp;</a>
                                <a href="?filter=aluno" class=""><strong class="text-primary">Aluno</strong></a>
                            </p>
                            <p>
                                <a href="?filter=cliente" class="badge rounded-circle bg-warning text-decoration-none">&nbsp;</a>
                                <a href="?filter=cliente" class=""><strong class="text-warning">Cliente</strong></a>

                            </p>
                            <p>
                                <a href="?filter=professor" class="badge rounded-circle bg-success text-decoration-none">&nbsp;</a>
                                <a href="?filter=professor" class=""><strong class="text-success">Professor</strong></a>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($searchUser && empty($searchResults)): ?>
            <div class="container mt-3 d-flex justify-content-center">
                <div class="alert alert-warning" role="alert">
                    Nenhum usuário encontrado com "<?= htmlspecialchars($searchUser) ?>".
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($searchResults)): ?>
            <div class="container mt-3">
                <h2>Resultados</h2>
                <?php foreach ($searchResults as $result): ?>
                    <?php
                    $badgeClass = match ($result['perfil']) {
                        'professor' => "rounded-circle border border-3 border-success",
                        'aluno' => "rounded-circle border border-3 border-primary",
                        'cliente' => "rounded-circle border border-3 border-warning",
                        'admin' => "rounded-circle border border-3 border-danger",
                        default => "rounded-circle border border-3 border-secondary",
                    };
                    ?>
                    <div class="card cardCavera p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="./perfilVer.php?id=<?= htmlspecialchars($result["id_usuario"]) ?>">
                                    <?php if (!empty($result['foto']) && file_exists("../foto/" . $result['foto'])): ?>
                                        <img src="../foto/<?= htmlspecialchars($result['foto']) ?>" alt="Foto de <?= htmlspecialchars($result['nome']) ?>" class="<?= $badgeClass ?>" width="50" height="50">
                                    <?php else: ?>
                                        <i class="bi bi-person-circle <?= $badgeClass ?>" style="font-size: 40px; padding: 8px; width: 50px; height: 50px; display: inline-flex; justify-content: center; align-items: center;" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </a>
                                <p class="mb-0 ms-3">
                                    <?= htmlspecialchars($result["nome"]) . " • " . htmlspecialchars(formatCPF($result["cpf"])) ?>
                                </p>
                            </div>

                            <div class="col d-flex justify-content-end align-items-center">
                                <form method="POST" action="" class="d-flex align-items-center">
                                    <input type="hidden" name="perfil_usuario" value="<?= $result['id_usuario'] ?>">
                                    <?php if ($result['status'] === '1'): ?>
                                        <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#reativarModal-<?= $result['id_usuario'] ?>" data-id_usuario="<?= $result['id_usuario'] ?>">Reativar</button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#reativarModal-<?= $result['id_usuario'] ?>" data-id_usuario="<?= $result['id_usuario'] ?>">Alterar</button>
                                    <?php endif; ?>
                                </form>
                            </div>


                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="container mt-3">
            <div class="d-flex align-items-center">
                <h2>Usuários</h2>

                <div class="d-flex mx-2 mt-2">
                    <p>
                        <a href="?filter=0"><strong class="text-success">Ativos</strong></a>

                    </p>
                </div>

                <div class="d-flex mt-2">
                    <p>
                        <a href="?filter=1"><strong class="text-danger">Inativos</strong></a>

                    </p>
                </div>

            </div>

            <?php foreach ($defaultResults as $result): ?>
                <?php

                $badgeClass = match ($result['perfil']) {
                    'professor' => "rounded-circle border border-3 border-success",
                    'aluno' => "rounded-circle border border-3 border-primary",
                    'cliente' => "rounded-circle border border-3 border-warning",
                    'admin' => "rounded-circle border border-3 border-danger",
                    default => "rounded-circle border border-3 border-secondary",
                };
                ?>
                <div class="card cardCavera p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="./perfilVer.php?id=<?= htmlspecialchars($result["id_usuario"]) ?>">
                                <?php if (!empty($result['foto']) && file_exists("../foto/" . $result['foto'])): ?>
                                    <img src="../foto/<?= htmlspecialchars($result['foto']) ?>" alt="Foto de <?= htmlspecialchars($result['nome']) ?>" class="<?= $badgeClass ?>" width="50" height="50">
                                <?php else: ?>
                                    <i class="bi bi-person-circle <?= $badgeClass ?>" style="font-size: 40px; padding: 8px; width: 50px; height: 50px; display: inline-flex; justify-content: center; align-items: center;" aria-hidden="true"></i>
                                <?php endif; ?>
                            </a>


                            <div class="d-flex flex-column flex-md-row">
                                <p class="mb-0 ms-3">
                                    <?= htmlspecialchars($result["nome"]) . " • "  ?>
                                </p>
                                <p class="mb-0 ms-3 ms-md-1">

                                    <?= htmlspecialchars(formatCPF($result["cpf"])) ?>

                                </p>
                            </div>

                        </div>

                        <div class="col d-flex justify-content-end align-items-center">
                            <form method="POST" action="" class="d-flex align-items-center">
                                <input type="hidden" name="perfil_usuario" value="<?= $result['id_usuario'] ?>">
                                <?php if ($result['status'] === '1'): ?>
                                    <button type="button" class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#reativarModal-<?= $result['id_usuario'] ?>" data-id_usuario="<?= $result['id_usuario'] ?>">Reativar</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#reativarModal-<?= $result['id_usuario'] ?>" data-id_usuario="<?= $result['id_usuario'] ?>">Alterar</button>
                                <?php endif; ?>
                            </form>
                        </div>


                    </div>
                </div>

                <div class="modal fade" id="reativarModal-<?= $result['id_usuario'] ?>" tabindex="-1" aria-labelledby="reativarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reativarModalLabel">
                                    Modificar Usuário
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="">
                                    <label for="perfil">Selecione o novo perfil:</label>
                                    <form method="POST" action="#" id="alterarPerfilFormReativar">
                                        <input type="hidden" name="id_usuario" value="<?= $result['id_usuario'] ?>">
                                        <select name="novo_perfil" id="perfil" class="form-control" required>
                                            <option value="" hidden><?= $result['perfil'] ?></option>
                                            <option value="admin">Admin</option>
                                            <option value="professor">Professor</option>
                                            <option value="aluno">Aluno</option>
                                            <option value="cliente">Cliente</option>
                                        </select>
                                        <div class="d-flex justify-content-end mt-2 ">
                                            <button type="submit" name="alterar_perfil" class="btn btn-success rounded-pill">Alterar</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                            <div class="modal-footer">

                                <button type="button" data-bs-dismiss="modal" class="btn btn-secondary rounded-pill">Cancelar</button>


                                <?php if ($result['status'] === '1'): ?>

                                    <form method="POST" action="#">
                                        <input type="hidden" name="id_usuario" value="<?= $result['id_usuario'] ?>">
                                        <button type="submit" name="reativar_usuario" class="btn btn-success rounded-pill">Reativar</button>
                                    </form>

                                <?php else: ?>

                                    <form method="POST" action="#">
                                        <input type="hidden" name="id_usuario" value="<?= $result['id_usuario'] ?>">
                                        <button type="submit" name="desativar_usuario" class="btn btn-danger rounded-pill">Desativar</button>
                                    </form>

                                <?php endif; ?>




                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </main>

    <?php include_once("./footer.php"); ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/cavera.js"></script>
</body>

</html>