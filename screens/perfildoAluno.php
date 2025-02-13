<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

// Recuperar informações do usuário logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$login = $select->fetch(PDO::FETCH_ASSOC);

// Buscar os posts criados pelo usuário (verifique o nome correto da coluna)
$sql = "SELECT p.id_post, p.titulo AS nomeCorte, i.url_img, p.data_criacao
        FROM post p
        LEFT JOIN img_post i ON p.id_post = i.id_post
        WHERE p.id_usuario = :id_usuario
        ORDER BY p.data_criacao DESC";

$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$posts = $select->fetchAll(PDO::FETCH_ASSOC);

unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="container-fluid flex-column justify-content-between">

    <?php include_once("./header.php"); ?>

    <main class="container-fluid text-center">
        <h5 class="fw-bold"><?= htmlspecialchars($login["nome"]) ?></h5>
        <h6 class="fw-bold <?= $perfil == 'professor' ? 'text-success' : ($perfil == 'aluno' ? 'text-primary' : ($perfil == 'cliente' ? 'text-warning' : 'text-danger')) ?>">
            <?= htmlspecialchars($login["perfil"]) ?>
        </h6>
        <p class="text-center"><?= htmlspecialchars($login["biografia"]) ?></p>
        <hr>

        <!-- Botão para adicionar foto -->
        <div class="d-flex justify-content-center mb-3">
            <a href="<?= BASE_URL ?>screens/criarPost.php">
                <button class="btn btn-outline-secondary border border-dark">
                    <i class="bi bi-plus" style="font-size: 2rem; color: black;"></i>
                </button>
            </a>
        </div>

        <!-- Galeria de posts -->
        <div class="row d-flex justify-content-center g-2">
            <?php if (!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="../postAluno/<?= htmlspecialchars($post["url_img"] ?? 'placeholder.jpg') ?>"
                                class="card-img-top" style="object-fit: cover; width: 100%; height: 300px;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($post["nomeCorte"]) ?></h5>
                                <p class="card-text"><small class="text-muted">
                                        <?= date('d/m/Y, H:i', strtotime($post['data_criacao'])) ?>
                                    </small></p>
                                <!-- Botão para excluir post -->
                                <a href="<?= BASE_URL ?>src/logicos/deletePost.php?id=<?= $post['id_post'] ?>"
                                    onclick="return confirm('Tem certeza que deseja excluir este post?')">
                                    <i class="bi bi-trash text-danger"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-center text-muted">Nenhum post encontrado.</p>
            <?php endif; ?>
        </div>


    </main>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include_once("./footer.php"); ?>

</body>

</html>