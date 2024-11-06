<?php  
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Avaliações e Comentários</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php include_once("./header.php"); ?>

<div class="container-fluid mt-3">
    <a href="#" class="btn btn-link text-decoration-none text-dark">
        <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
    </a>
</div>

<main class="container-fluid mt-3 flex-grow-1">
    <h1 class="text-center laranja-senac">Área do Instrutor</h1>
    
    <div class="row bg-light d-flex align-items-center w-100 mx-auto" style="max-width: 700px;">
        <div class="col text-end">
            <a href="#"><i class="bi bi-chevron-left"></i></a>
        </div>
        <div class="col text-center">
            <p class="mt-3 fw-bolder azul-senac fs-2">Avaliações</p>
        </div>
        <div class="col text-start">
            <a href="#"><i class="bi bi-chevron-right"></i></a>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center mt-3">
        <div class="d-flex align-items-center">
            <span>Ordenar Por:</span>
            <button class="btn btn-link mx-2 text-dark text-decoration-none">Por turma</button>
            <span>|</span>
            <button class="btn btn-link mx-2 text-dark text-decoration-none">Mais recente</button>
            <span>|</span>
            <button class="btn btn-link mx-2 text-dark text-decoration-none">Mais antigo</button>
        </div>
        
        <div class="mt-3">
            <?php include_once("./popUp.php"); ?>
        </div>
    </div>

    <?php for ($i = 0; $i < 3; $i++): ?>
    <div class="card mt-3" style="max-width: 700px; margin: 0 auto;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-circle fs-3 me-3"></i>
                    <div>
                        <h5 class="mb-0">Nome</h5>
                        <small class="text-muted">Serviço - Turma xx/xx/xxxx</small>
                    </div>
                </div>
                <div class="text-end">
                    <span class="d-block">Nome do Aluno</span>
                    <div class="text-warning">
                        <i class="bi bi-star-fill"></i> 4.0
                    </div>
                </div>
            </div>
            <p class="mt-3 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec nunc efficitur lacus imperdiet ullamcorper. In dignissim ipsum est, sit amet convallis ligula posuere vitae. Aliquam bibendum, tellus vitae hendrerit laoreet, orci felis aliquet.</p>
            <a href="#" class="text-primary">ler mais...</a>
        </div>
    </div>
    <?php endfor; ?>
</main>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

<footer>
    <?php include_once("./footer.php"); ?>
</footer>

</body>
</html>
