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

if ($perfil == 'professor') {
  $estilo = "border border-success border-3";
} elseif ($perfil == 'aluno') {
  $estilo = "border border-primary border-3";
} elseif ($perfil == 'cliente') {
  $estilo = "border border-warning border-3";
} elseif ($perfil == 'admin') {
  $estilo = "border border-danger border-3 ";
}

// Recuperar informações do usuário logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
$select->execute();
$login = $select->fetch(PDO::FETCH_ASSOC);

$sql =  "SELECT
    p.id_post,
    p.titulo AS titulo_post,
    GROUP_CONCAT(i.url_img) AS imagens,
    c.descricao AS descricao_curso,
    p.data_criacao AS data_criacao_post,
    p.texto AS texto_post,
    c.nome_do_curso AS nome_curso,
    t.numero_da_turma
FROM
    post p
LEFT JOIN
    img_post i ON p.id_post = i.id_post
LEFT JOIN
    alunos a ON p.id_usuario = a.id_usuario
LEFT JOIN
    turma t ON a.id_turma = t.id_turma
LEFT JOIN
    curso c ON t.id_curso = c.id_curso
WHERE
    p.id_usuario = :id_usuario
GROUP BY
    p.id_post, p.titulo, c.descricao, p.data_criacao, p.texto, c.nome_do_curso, t.numero_da_turma
ORDER BY
    p.data_criacao DESC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar a quantidade de posts
// $num_posts = count($posts);
// echo ("<pre>");
// var_dump($posts["0"]['imagens']);
// die;
unset($conexao);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviço - Corte de Cabelo</title>
  <meta name="author" content="Victor">
  <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">
  <?php
  include_once("./header.php");
  ?>
  <main>
    <div class="container">
      <!-- Flecha de retorno -->
      <div class="m-3">
        <i class="bi bi-arrow-left"></i>
      </div>
      <div class="mt-4">
        <div class="row mb-3">
          <div class=" col-6 d-flex align-items-center ">
            <h3 type="text" class="text-start fs-1 fw-bold laranja-senac">Blog</h3>
            <?php if ($perfil == "admin" || $perfil == "professor" || $perfil == "aluno") { ?>
              <div class="d-flex justify-content-center m-3">
                <a href="<?= BASE_URL ?>screens/criarPost.php">
                  <button class="btn btn-success border border-dark">
                    <i class="bi bi-plus" style="font-size: 2rem; color: white;"></i>
                  </button>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>



      <div class=" row d-flex justify-content-center">
        <!-- card -->
        <div class="card card-post border col-lg-3 m-1 <?= $post['id_post'] ?>">

          <!-- Carrossel de imagens -->
          <?php foreach ($posts as $post) { ?>

            <div class="d-flex justify-content-center align-items-center">
              <div id="carouselExampleInterval" class="row slide-blog carousel slide">
                <div class="carousel-inner">
                  <div class="carousel-item" data-bs-interval="3000">
                    <img src="../postAluno/<?= htmlspecialchars($post["imagens"] ?? 'placeholder.jpg') ?>" class="d-block w-100" alt="Imagem do post">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>

            <!--info-->

            <div class=" row ">
              <div class="col-6">
                <div class="row">
                  <div class="">
                    <a href="./Perfil.php"><img src="../foto/<?= $login['foto'] ?>" alt="Foto de perfil" class="img-perfil-mini m-2 <?= $estilo ?>"></a>
                    <a href="./Perfil.php">
                      <h5 class="d-flex fw-bold justify-content-center "> <?= $login["nome"] ?></h5> <br>
                    </a>
                  </div>
                </div>

                <div class="row fs-5 ms-1"></div>

              </div>

              <div class="col-6 pt-3 ">

                <div class="row d-flex justify-content-end pe-3 fs-5"> <?= $post['nome_curso'] ?> </div>
                <div class="row d-flex justify-content-end pe-3"><?= $post['titulo_post'] ?></div>
                <div class="row d-flex justify-content-end pe-3 fs-7">data da postagem</div>

              </div>

              <div class="row  ps-4 pt-4 text-secondary"> <?= $post['texto_post'] ?></div>
            <?php } ?>
            </div>
        </div>


        <!-- fim card -->







        <!-- MODAL ADICIONAR CURSO -->
        <div class="modal fade" id="modalAdicionarPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../src/logicos/adicionarPost.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Título do Post</label>
                    <input type="text" class="form-control" name="txtCurso" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Texto</label>
                    <input type="text" class="form-control" name="txtCurso" required>
                  </div>

                  <div class="mb-3">
                    <input type="text" class="form-control" name="txtCurso" value="" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-bold">Adicionar Imagem do Curso</label>
                    <input type="file" multiple name="imgCurso" class="form-control" accept="image/png, image/jpeg">
                  </div>

                  <div class="mb-3 d-flex justify-content-center">
                    <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>


  <!-- JavaScript do Bootstrap -->
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php include_once("./footer.php"); ?>
</body>

</html>