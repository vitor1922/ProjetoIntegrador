<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;
$idUsuario = $_SESSION['id_usuario'] ?? NULL;
$usuario = $_SESSION['nome'] ?? NULL;


$sql =  "SELECT
    p.id_post AS id_post,
    p.titulo AS titulo_post,
    GROUP_CONCAT(i.url_img) AS imagens,
    c.descricao AS descricao_curso,
    p.data_criacao AS data_criacao_post,
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
GROUP BY
    p.id_post, p.titulo, c.descricao, p.data_criacao, p.texto, c.nome_do_curso, t.numero_da_turma
ORDER BY
    p.data_criacao DESC";
$stmt = $conexao->prepare($sql);

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

<body class="container-fluid">
  <?php
  include_once("./header.php");
  ?>
  <main>

    <?php 
    
    echo(date("Y-m-d"))?>
    <div class="container-fluid">
    <a href="../index.php" class="m-3">
        <i class="bi bi-arrow-left-short fs-1 azul-senac"></i>
      </a>
    <div class="container">
      <!-- Flecha de retorno -->
      
      <div class="mt-4">
        <div class="row mb-3">
          <div class=" col-6 d-flex align-items-center ">
            <h3 type="text" class="text-start fs-1 fw-bold laranja-senac">Blog</h3>
            <?php if ($perfil == "admin" || $perfil == "professor" || $perfil == "aluno") { ?>
              <button type="button" class="ms-2 btn btn-primary btn-azul-senac" data-bs-toggle="modal" data-bs-target="#modalAdicionarPost">Adicionar Post</button>
            <?php } ?>
          </div>
        </div>
      </div>



      <div class=" row d-flex justify-content-center">
        <?php foreach($posts as $post){?>
          <?php 
            $imagens = explode(",", $post["imagens"]);
            $contagem = 0;
            ?>
        <!-- card -->
        <div class="card card-post border col-lg-3 m-1">
        <div class="col-1 d-flex justify-content-start position-absolute z-1 end-0">
                                <button class="btn text-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalExcluirCurso<?= $curso["id_curso"] ?>">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>

          <!-- Carrossel de imagens -->
          <div class=" d-flex justify-content-center align-items-center">
            <div id="carouselExampleInterval<?=$post["id_post"]?>" class="row slide-blog carousel slide">
              <div class="carousel-inner">
                <?php foreach($imagens as $imagem){?>
                <div class="carousel-item active">
                  <img src="../postAluno/<?=$imagem?>" class="d-block w-100 slide-blog" alt="...">
                </div>
                <?php 
                $contagem += 1;

                ?>
                <?php }?>
              </div>
              <?php if($contagem > 1){?>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval<?=$post["id_post"]?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval<?=$post["id_post"]?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
              <?php }?>
            </div>
          </div>
          <!--info-->
          <div class=" row ">
            <div class="col-6">
              <div class="row">
                <a href="./perfilVer.php?id=<?=$post["id_usuario"]?>" class=" text-black">
                  <img src="../foto/<?=$post["foto_usuario"]?>" alt="Foto de perfil" class="img-perfil-mini">

                  <?php $nomeEx = explode(" ",$post["nome_usuario"]);
                        $primeiroNome = $nomeEx[0];
                  ?>
                  <label class="fs-7"><?=$primeiroNome?> </label>
                </a>
              </div>

              <div class="row fs-5 ms-1"><?=$post["titulo_post"]?></div>


            </div>
            <div class="col-6 pt-3 ">
              <div class="row d-flex justify-content-end pe-3 fs-5"><?=$post["nome_curso"]?></div>
              <div class="row d-flex justify-content-end pe-3">turma <?=$post["numero_da_turma"]?></div>
              <div class="row d-flex justify-content-end pe-3 fs-7"><?=$post["data_criacao_post"]?></div>


            </div>
            <div class="row  ps-4 pt-4 text-secondary"><?=$post["texto_post"]?></div>
          </div>
        </div>


        <!-- fim card -->
        <?php }?>






        <!-- MODAL ADICIONAR POST -->
        <div class="modal fade" id="modalAdicionarPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="d-flex justify-content-end mb-3">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../src/logicos/adicionarPostBlog.php" method="POST" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Título do Post</label>
                    <input type="text" class="form-control" name="txtTitulo" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Texto</label>
                    <input type="text" class="form-control" name="txtTexto" required>
                  </div>

                  <div class="mb-3">
                    <input type="text" class="form-control" name="txtUsuario" value="<?=$idUsuario?>" required hidden>
                    <input type="text" class="form-control" name="txtData" value="<?=date("Y-m-d",)?>" required hidden>
                  </div>
                 
                  <div class="mb-3">
                    <label class="form-label fw-bold">Adicionar Imagem do Curso</label>
                    <input type="file" multiple="multiple" name="imgsPost[]" class="form-control" accept="image/png, image/jpeg" required>
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
    </div>
  </main>


  <!-- JavaScript do Bootstrap -->
  <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <?php include_once("./footer.php"); ?>
</body>

</html>