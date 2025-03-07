<?php
include('../constantes.php');
include_once("../data/conexao.php");

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
$nome = $_SESSION['nome'] ?? "";
// NÃO MEXER NA REQUISIÇÃO GET, ELA ESTÁ LINKADA A TELA USUARIOS
$id_usuario = $_GET['id'] ?? "";

// Buscar dados do usuário
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$login = $select->fetch(PDO::FETCH_ASSOC);


// Buscar posts do usuário
$sql = "SELECT p.id_post, p.titulo AS nomeCorte, i.url_img, p.data_criacao
            FROM post p
            LEFT JOIN img_post i ON p.id_post = i.id_post
            WHERE p.id_usuario = :id_usuario
            ORDER BY p.data_criacao DESC";

$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$posts = $select->fetchAll(PDO::FETCH_ASSOC);
$sql = "SELECT p.id_post, p.titulo  AS nomeCorte, i.url_img, p.data_criacao
        FROM post p
        LEFT JOIN img_post i ON p.id_post = i.id_post
        WHERE p.id_usuario = :id_usuario
        ORDER BY p.data_criacao DESC";

$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$posts = $select->fetchAll(PDO::FETCH_ASSOC);

$callCourse = "SELECT c.nome_do_curso FROM curso c
INNER JOIN turma t ON t.id_curso = c.id_curso
INNER JOIN alunos a ON a.id_turma = t.id_turma
WHERE a.id_usuario = :id_usuario";
$select = $conexao->prepare($callCourse);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$callCourse = $select->fetch(PDO::FETCH_ASSOC);
$num_posts = count($posts);

if ($perfil == 'professor') {
    $estilo = "border border-success border-3";
} elseif ($perfil == 'aluno') {
    $estilo = "border border-primary border-3";
} elseif ($perfil == 'cliente') {
    $estilo = "border border-warning border-3";
} elseif ($perfil == 'admin') {
    $estilo = "border border-danger border-3 ";
}

// coisa dos txt

if ($perfil === 'professor') {
    $estiloTXT = "text-success";
} elseif ($perfil === 'aluno') {
    $estiloTXT = "text-primary";
} elseif ($perfil === 'cliente') {
    $estiloTXT = "text-warning";
} elseif ($perfil === 'admin') {
    $estiloTXT = "text-danger";
}
// Estilos por perfil

// $estilos = [
//     'professor' => ['border-success border-4', 'text-success'],
//     'aluno' => ['border-primary border-4', 'text-primary'],
//     'cliente' => ['border-warning border-4', 'text-warning'],
//     'admin' => ['border-danger border-4', 'text-danger']
// ];

// $estilo = $estilos[$login['perfil']][0] ?? 'border-secondary';
// $estiloTXT = $estilos[$login['perfil']][1] ?? 'text-secondary';

// var_dump($id_usuario);

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
    <title>Perfil de <?= htmlspecialchars($login["nome"]) ?></title>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">
    <?php include_once("./header.php"); ?>
    <?php include_once("./preloader.php"); ?>

        <main class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-0 shadow-sm">
                        <div class="position-relative mb-4">
                            <img src="../bannerP/<?= $login['banner'] ? $login['banner'] : 'SenacLogo.jpg' ?>" class="w-100" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-100 start-50 translate-middle">
                                <img src="../foto/<?= $login['foto'] ? $login['foto'] : 'iconPerfil.jpg' ?> " class="rounded-circle border <?= $estilo ?>" width="120" height="120">
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <h4 class="fw-bold">
                                <span class="text-dark"><?= htmlspecialchars($login["nome"]) ?></span>
                                <span class="<?= $estiloTXT ?>">• <?= $login["perfil"] ?></span>
                                <span class=" .text-black"> <?= $callCourse['nome_do_curso'] ?? 'O usuário nao esta em um curso' ?></span>
                            </h4>
                            <p class="text-muted"><?= htmlspecialchars($login["biografia"]) ?></p>
                            <span><strong><?= $num_posts ?></strong> publicações</span>
                        </div>

                        <div class="row mt-4 p-3">
                            <?php if (!empty($posts)) : ?>
                                <?php foreach ($posts as $post) : ?>
                                    <div class="col-4 mb-3">
                                        <div class="position-relative border border-2 border-black rounded">
                                            <img src="../postAluno/<?= htmlspecialchars($post["url_img"] ?? 'placeholder.jpg') ?>"
                                                class="w-100 rounded post-img" style="aspect-ratio: 1/1; object-fit: cover; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#postModal"
                                                data-img="../postAluno/<?= htmlspecialchars($post["url_img"] ?? 'placeholder.jpg') ?>"
                                                data-title="<?= htmlspecialchars($post["nomeCorte"]) ?>"
                                                data-date="<?= date('d/m/Y, H:i', strtotime($post['data_criacao'])) ?>">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-center text-muted">Nenhuma postagem encontrada.</p>
                            <?php endif; ?>
                        </div>

                        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="postModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="postModalImg" class="img-fluid rounded">
                                        <p class="text-muted mt-2" id="postModalDate"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var postImages = document.querySelectorAll(".post-img");
                                postImages.forEach(img => {
                                    img.addEventListener("click", function() {
                                        document.getElementById("postModalLabel").textContent = this.getAttribute("data-title");
                                        document.getElementById("postModalImg").src = this.getAttribute("data-img");
                                        document.getElementById("postModalDate").textContent = this.getAttribute("data-date");
                                    });
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </main>

    <?php include "./footer.php"; ?>
    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>