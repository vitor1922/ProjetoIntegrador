<?php
#inicia as variaveis de sessão
include('../constantes.php');
include_once('../data/conexao.php');

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";


if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}
// Mostrar dados do usuario logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);
if ($select->execute()) {
    $login = $select->fetch(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - BLOG</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <?php include_once("./header.php"); ?>

    <main class="container-fluid mt-5">

        <form action="<?= BASE_URL ?>src/logicos/PostAluno.php" method="POST" enctype="multipart/form-data">
            <div class="row offset-md-2">
                <div class="mb-3">
                    <label for="txtTituloPost" class="form-label">Nome do Corte</label>
                    <input type="text" id="txtTituloPost" class="form-control" name="txtTituloPost" autofocus="true" required>
                </div>

                <!-- talvez possa ser usado depois!! -->
                <!-- <div class="mb-3">
                    <label for="txtConteudoPost" class="form-label">Conteúdo Post</label>
                    <textarea type="text" id="txtConteudoPost" class="form-control" rows="10" name="txtConteudoPost" required></textarea>
                </div> -->

                <div class="mb-3">
                    <label for="poster_path" class="col-sm-8 col-form-label">Carregar Imagem</label>
                    <input type="file" name="postAluno" class="form-control" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                </div>

            
                <img id="fotoPreview" src="" alt="Prévia da imagem" style="display: none; max-width: 200px; margin-top: 10px;">

                <script>
                    function previewImage(event) {
                        const input = event.target;
                        const preview = document.getElementById('fotoPreview');

                        if (input.files && input.files[0]) {
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

                <div class="mb-3">
                    <button onclick="window.history.back();">Voltar</button>
                    <button type="submit" class="btn btn-success mb-3 ">Criar Post</button>
                </div>
            </div>

        </form>
        <div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert alert-danger mt-2"><?= $mensagem ?></p>
            <?php } ?>
        </div>
    </main>
    <?php
    include "./footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script>
        document.getElementById('imgPosts').addEventListener('change', previewImage);
    </script>
</body>

</html>