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

// $perfil = "cliente";
// border colors of each user role 
if ($perfil == 'professor') {
    $estilo = "bg-success";
} elseif ($perfil == 'aluno') {
    $estilo = "bg-primary";
} elseif ($perfil == 'cliente') {
    $estilo = "bg-warning";
} elseif ($perfil == 'admin') {
    $estilo = "bg-danger";
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
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Perfil</title>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">

    <?php include_once("./header.php"); ?>

    <main class="container mt-5">

        <div class=" d-flex justify-content-center mt-4 align-content-center mb-5 ">
            <div class=" card d-flex justify-content-center border-4 shadow-lg col">
                <div class="headerPerfil d-flex justify-content-center align-items-center">
                    <div class="profile-background <?= $estilo ?>">
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center flex-column flex-md-row mt-5">
                    <div class="d-flex justify-content-center">
                        <img src="../foto/<?= $login['foto'] ?>" class="imgPerfil bordaa border border-black" name="foto" alt="Imagem de perfil">
                    </div>
                    <div class="ms-0 ms-md-5 mt-3 mt-md-0 d-flex flex-column justify-content-center">
                        <h5 class="d-flex fw-bold justify-content-center m-0"><?= $login["nome"] ?></h5> <br>
                        <h6 class=" d-flex fw-bold justify-content-center m-0" id="cargoProfile"><?= $login["perfil"] ?></h6> <br>
                        <p class="text-center"><?= $login["biografia"] ?></p>
                    </div>
                </div>
                <div class="card-body">
                    <a href="./editarPerfil.php" class="btn border shadow-sm fw-bold azul-senac border-3 rounded-4 d-flex justify-content-center mb-3">Editar Perfil</a>
                    <a href="./configuracoes.php" class="link-offset-2 link-underline link-underline-opacity-0">
                        <div class="btn text-light shadow-sm fw-bold btn-azul-senac border-3 rounded-4 d-flex justify-content-center " type="button" href="">Configurações</div>
                    </a>
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