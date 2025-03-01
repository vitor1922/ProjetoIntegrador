<!-- CRIADOR: MALINSKI -->

<?php
#inicia as variaveis de sessão
include('../constantes.php');
include_once("../data/conexao.php");


session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";


// $perfil = "cliente";
// border colors of each user role 
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

if ($perfil == 'professor') {
    $estiloTXT = "text-success";
} elseif ($perfil == 'aluno') {
    $estiloTXT = "text-primary";
} elseif ($perfil == 'cliente') {
    $estiloTXT = "text-warning";
} elseif ($perfil == 'admin') {
    $estiloTXT = "text-danger";
}


if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
// Mostrar dados do usuario logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$login = $select->fetch(PDO::FETCH_ASSOC);

// Buscar os posts criados pelo usuário
$sql =  "SELECT
    p.id_post AS id_post,
    p.titulo AS nomeCorte,
    GROUP_CONCAT(i.url_img) AS imagens,
    c.descricao AS descricao_curso,
    p.data_criacao AS data_criacao,
    p.texto AS texto_post,
    c.nome_do_curso AS nome_curso,
    t.numero_da_turma AS numero_da_turma,
    u.nome AS nome_usuario,
    u.foto AS foto_usuario,
    u.id_usuario AS id_usuario

FROM
    post p
LEFT JOIN 
    usuario u ON u.id_usuario = p.id_usuario
LEFT JOIN
    img_post i ON p.id_post = i.id_post
LEFT JOIN
    alunos a ON p.id_usuario = a.id_usuario
LEFT JOIN
    turma t ON a.id_turma = t.id_turma
LEFT JOIN
    curso c ON t.id_curso = c.id_curso
WHERE u.id_usuario = :id_usuario
GROUP BY
    p.id_post, p.titulo, c.descricao, p.data_criacao, p.texto, c.nome_do_curso, t.numero_da_turma
    
ORDER BY
    p.data_criacao DESC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$callCourse = "SELECT c.nome_do_curso FROM curso c
INNER JOIN turma t ON t.id_curso = c.id_curso
INNER JOIN alunos a ON a.id_turma = t.id_turma
WHERE a.id_usuario = :id_usuario";
$select = $conexao->prepare($callCourse);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$callCourse = $select->fetch(PDO::FETCH_ASSOC);
// Contar a quantidade de posts
$num_posts = count($posts);


//  echo("<pre>");
//  var_dump($callCourse);
//  die;

unset($conexao);
?>

<?php include_once("../constantes.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Perfil</title>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0 ">

    <?php include_once("./header.php"); ?>
    <?php include_once("./preloader.php"); ?>


    <main class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-0 shadow-sm">
                    <div class="position-relative mb-4 ">
                        <!-- banner e foto -->
                        <img src="../bannerP/<?= $login['banner'] ? $login['banner'] : 'SenacLogo.jpg' ?>" class="w-100" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-100 start-50 translate-middle">
                            <img src="../foto/<?= $login['foto'] ? $login['foto'] : 'iconPerfil.jpg' ?> " class="rounded-circle border <?= $estilo ?>" width="120" height="120">
                        </div>
                    </div>

                    <!-- nome, perfil, bio, editar perifl -->
                    <div class="text-center mt-5">
                        <h4 class="fw-bold">
                            <span class="text-dark"><?= htmlspecialchars($login["nome"]) ?></span>
                            <span class="<?= $estiloTXT ?>">• <?= $login["perfil"] ?></span>
                            <span class=" .text-black"> <?= $callCourse['nome_do_curso'] ?? 'O usuário nao esta em um curso' ?></span>

                        </h4>

                        <h6 class="fw-bolder </h6>
                        <p class=" text-muted"><?= htmlspecialchars($login["biografia"] ?? '') ?></p>

                            <div class="d-flex justify-content-center gap-3">

                                <span><strong><?= $num_posts ?></strong> publicações</span>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-center mb-3">
                                    <a href="<?= BASE_URL ?>screens/criarPost.php">
                                        <button class="btn btn-success border border-dark">
                                            <i class="bi bi-plus" style="font-size: 2rem; color: white;"></i>
                                        </button>
                                    </a>
                                </div>
                                <a href="./editarPerfil.php" class="btn btn-outline-dark btn-sm">Editar Perfil</a>
                                <a href="./configuracoes.php" class="btn btn-outline-secondary btn-sm">Configurações</a>
                            </div>
                    </div>
                    <!-- Grid dos posts -->
                    <div class="row mt-4 p-3 ">

                        <?php if (!empty($posts)) : ?>
                            <?php foreach ($posts as $post) : ?>
                                <?php
                                $imagens = explode(",", $post["imagens"]);
                                $contagem = 0;
                                ?>
                                <div class="post-container mb-4">
                                    <!-- Carousel de imagens do post -->
                                    <div id="carouselExampleInterval<?= $post["id_post"] ?>" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($imagens as $index => $imagem) { ?>
                                                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                                                    <img src="../postAluno/<?= $imagem ?>" class="d-block w-100" alt="Imagem do post"
                                                        data-bs-toggle="modal" data-bs-target="#postModal"
                                                        data-img="../postAluno/<?= htmlspecialchars($post["url_img"] ?? 'placeholder.jpg') ?>"
                                                        data-title="<?= htmlspecialchars($post["nomeCorte"]) ?>"
                                                        data-date="<?= date('d/m/Y, H:i', strtotime($post['data_criacao'])) ?>">
                                                </div>
                                                <?php
                                                $contagem += 1;
                                                ?>
                                            <?php } ?>
                                        </div>

                                        <!-- Controles do carrossel -->
                                        <?php if ($contagem > 1) { ?>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval<?= $post["id_post"] ?>" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Anterior</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval<?= $post["id_post"] ?>" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Próximo</span>
                                            </button>
                                        <?php } ?>
                                    </div>

                                    <!-- Informação do post -->
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="post-title">
                                            <h5><?= htmlspecialchars($post["nomeCorte"]) ?></h5>
                                            <span class="text-muted"><?= date('d/m/Y, H:i', strtotime($post['data_criacao'])) ?></span>
                                        </div>
                                        <a href="<?= BASE_URL ?>src/logicos/deletePost.php?id=<?= $post['id_post'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tem certeza que deseja excluir este post?')">
                                            <i class="bi bi-trash"></i> Excluir
                                        </a>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

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


    <?php
    include "./footer.php";
    ?>
    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>
</body>

</html>