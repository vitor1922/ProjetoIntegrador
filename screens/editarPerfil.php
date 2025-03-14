<?php
include_once('../data/conexao.php');
include('../constantes.php');

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? FALSE;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";


if ($perfil == 'professor') {
    $estilo = "border border-success rounded-circle border border-3 m-2";
} elseif ($perfil == 'aluno') {
    $estilo = "border-primary rounded-circle border border-3 m-2;";
} elseif ($perfil == 'cliente') {
    $estilo = "border border-warning rounded-circle border border-3 m-2;";
} elseif ($perfil == 'admin') {
    $estilo = "border border-danger rounded-circle border border-3 m-2";
}

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$select->execute();
$login = $select->fetch(PDO::FETCH_ASSOC) ?? [];

$id_post = $_GET['id_post'] ?? NULL;
$post = [];
if ($id_post) {
    $sql = "SELECT * FROM post WHERE id_post = :id_post";
    $select = $conexao->prepare($sql);
    $select->bindParam(':id_post', $id_post, PDO::PARAM_INT);
    $select->execute();
    $post = $select->fetch(PDO::FETCH_ASSOC) ?? [];
}

unset($conexao);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <meta name="author" content="Jose">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex justify-content-between flex-column min-vh-100 p-0">
    <?php
    include("./header.php");
    ?>

    <main>
        <div class="d-flex justify-content-between align-items-center">
        <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>" class="bi bi-arrow-left fs-3 m-5"></i></a>
        </div>
        <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropModalLabel">Ajustar Imagem</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <img id="cropImage" src="" class="img-fluid">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="cropButton">Cortar e Salvar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center align-content-center mb-2">
            <div class="card d-flex justify-content-center border-4 shadow-lg col-lg-12">
                <form method="POST" action="<?= BASE_URL ?>src/logicos/updatePerfil.php" enctype="multipart/form-data">
                    <div class="headerPerfil d-flex position-relative justify-content-center">
                        <div class="profile-background">
                            <button type="button" class="btn position-absolute top-0 end-0 m-2" onclick="removerImagem('banner')">
                                <i class="bi bi-trash text-danger"></i>
                            </button>
                            <img id="bannerPreview" src="../bannerP/<?= $login['banner'] ?>" class="img-fluid" name="banner" alt="Imagem de perfil">
                        </div>
                        <input type="text" name="imgBanner" value="<?= $login['banner'] ?>" hidden>
                    </div>
                    <div class="profileP">
                        <button type="button" class="btn position-absolute top-50 mx-3 m-2" onclick="removerImagem('perfil')">
                            <i class="bi bi-trash text-danger"></i>
                        </button>
                        <img id="fotoPreview" src="../foto/<?= $login['foto'] ?>" class="rounded-circle border <?= $estilo ?>" name="foto" alt="Imagem de perfil" width="120" height="120">
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <label class="btn btn-dark fw-bold rounded-pill px-4 py-2 mt-5">
                            <i class="bi bi-image-fill"></i> Alterar foto de perfil
                            <input type="file" name="foto" accept="image/jpg, image/png, image/jpeg" hidden onchange="openCropModal(this, 'fotoPreview')">
                        </label>
                        <input type="text" name="imgName" value="<?= $login['foto'] ?>" hidden>
                        <label class="btn fw-bold btn-dark rounded-pill px-4 py-2 mt-5">
                            <i class="bi bi-image-fill"></i> Alterar Banner
                            <input type="file" name="banner" accept="image/jpg, image/png, image/jpeg" hidden onchange="openCropModal(this, 'bannerPreview')">
                        </label>
                    </div>
                    <input type="text" id="nomeTextInput" class="form-control" name="txtUserId"
                        value="<?= $login['id_usuario'] ?? '' ?>" hidden>
                    <h6 class="card-text d-flex justify-content-center fw-bold mt-4" id="cargoProfile"> <?= $login['perfil'] ?? '' ?></h6>
                    <div class="col mb-3">
                        <div class="nomePerfil p-3">
                            <h6 class="fw-bold laranja-senac mx-2">Nome Atual:</h6>
                            <h5 class="card-title d-flex mx-1"><?= $login['nome'] ?? '' ?></h5> <br>
                            <label for="nome" class="form-label fw-bold azul-senac mx-2">Novo Nome</label>
                            <input type="text" name="txtNome" class="form-control mb-2" value="<?= $login['nome'] ?? '' ?>">
                        </div>
                        <h6 class="fw-bold laranja-senac mx-2">Bio Atual:</h6>
                        <p class="list-group-item mx-4"><?= $login["biografia"] ?></p>
                        <div class="nomePerfil">
                            <div class="mx-3 mb-3 fw-bold">
                                <label for="bio" class="form-label fw-bold azul-senac">Nova Bio</label>
                                <textarea class="form-control p-2" name="txtBiografia" rows="2"><?= $login['biografia'] ?? '' ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn text-light shadow-sm fs-4 fw-bold btn-azul-senac border-2 rounded-5 d-flex justify-content-center w-50">Confirmar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <?php
    include("./footer.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>

</body>
</html>