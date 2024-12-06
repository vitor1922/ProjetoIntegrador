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



$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";
$img_post = $_SESSION['img_post'];
$post = $_SESSION['post'];
// $perfil = "cliente";

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
// Mostrar dados do usuario logado
$sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
$select = $conexao->prepare($sql);
$select->bindParam(':id_usuario', $id_usuario);

if ($select->execute()) {
    $login = $select->fetch(PDO::FETCH_ASSOC);
}

//  echo("<pre>");
//  var_dump($login);
//  die;


unset($conexao);
?>

<?php include_once("../constantes.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title> ESCREVER AQUI DPS </title> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
</head>

<body class="d-flex flex-column justify-content-between">
    <!-- Header -->
    <?php
    include_once("./header.php");
    ?>

    <main>
        <div class="container text-center">
            <!-- Perfil -->
            <div class="position-relative mt-3">
                <img src="../foto/<?= $login['foto'] ?>" alt="Foto de perfil" class="rounded-circle img-fluid mb-3 mt-1 <?= $estilo ?>" style="width: 120px; height: 120px;">
                <h5 class="card-title d-flex justify-content-center fw-bold "><?= $login["nome"] ?></h5> <br>
                <h5 class=""> <?= $login["perfil"] ?></h5>
                <a href="./editarPerfil.php"><button class="btn position-absolute top-0 end-0 me-2 btn-primary">Editar Perfil</button></a>
            </div>

            <h5 class="card-title d-flex justify-content-center fw-bold "></h5> <br>
            <div class="bio mb-3">
                <p class="list-group-item"><?= $login["biografia"] ?></p>
            </div>

            <!-- Botão Configurações -->
            <a href="./configuracoes.php"><button class="btn btn-primary mb-4 w-100" style="max-width: 200px;">Configurações</button></a>

            <hr style="border: none; border-top: 1px solid black; width: 100%; margin: 30px 0;">

            <!-- Botão para adicionar foto -->
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-secondary w-38 h-100 d-flex align-items-center justify-content-center border border-dark">
                    <i class="bi bi-plus" style="font-size: 2rem; color: black;"></i>
                </button>
            </div>

            <!-- Galeria de fotos -->


            <div class="row d-flex justify-content-center g-2 mt-3 mb-3">

                <div class="card" style="width: 18rem;">
                    <img src="<?= ['img_post'] ?> " class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"> <?= ['texto'] ?> </p>
                    </div>
                </div>
                <div class="col-4 col-md-2">
                    <a href=""><img src="" class="img-fluid rounded" alt="Foto 2"></a>
                </div>
                <div class="col-4 col-md-2">
                    <a href=""><img src="" class="img-fluid rounded" alt="Foto 3"></a>
                </div>
                <div class="col-4 col-md-2">
                    <a href=""><img src="" class="img-fluid rounded" alt="Foto 4"></a>
                </div>
                <div class="col-4 col-md-2">
                    <a href=""><img src="" class="img-fluid rounded" alt="Foto 5"></a>
                </div>
                <div class="col-4 col-md-2">
                    <a href=""><img src="" class="img-fluid rounded" alt="Foto 6"></a>
                </div>
            </div>
            <main>
        </div>
        <!-- Bootstrap JS -->
        <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
        <?php include_once("./footer.php"); ?>
</body>

</html>