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
    <title>Área do Instrutor</title>
</head>
<body class="d-flex flex-column min-vh-100">
<?php 
include_once("./header.php"); 
?>

<div class="container-fluid mt-3">
    <a href="../index.php" class="btn btn-link">
        <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
    </a>
</div>

<main class="flex-grow-1">
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <a href="./turmasProfessores.php" class="text-decoration-none text-dark">
                    <div class="card d-flex flex-column align-items-center border-0">
                        <div class="image-container">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSI82Gcx4qvLD41uZwxiIJvmkU9sq5p7I-u5uqKdk0I35Vh4AH8" alt="Turmas" class="card-image">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning">Turmas</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <a href="./estoqueProfessor.php" class="text-decoration-none text-dark">
                    <div class="card d-flex flex-column align-items-center border-0">
                        <div class="image-container">
                            <img src="https://cdn-icons-png.flaticon.com/512/3121/3121768.png" alt="Estoque" class="card-image">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning">Estoque</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <a href="./agendamento.php" class="text-decoration-none text-dark">
                    <div class="card d-flex flex-column align-items-center border-0">
                        <div class="image-container">
                            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcToLzfeMFYcjlicL3YTb6y9DG85-Q19rxxdKuw0yfcP5oamMLJq" alt="Agendamentos" class="card-image">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning">Agendamento</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <a href="./avaliacoesComentarios.php" class="text-decoration-none text-dark">
                    <div class="card d-flex flex-column align-items-center border-0">
                        <div class="image-container">
                            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRVDblf9NGuc4co8nFnPEvgA_zcO2A352GquF4Rr0NtKzcBiGxe" alt="Avaliações" class="card-image">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning">Avaliações</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <a href="./gerenciamento.php" class="text-decoration-none text-dark">
                    <div class="card d-flex flex-column align-items-center border-0">
                        <div class="image-container">
                            <img src="https://cdn.icon-icons.com/icons2/1524/PNG/512/gear_106450.png" alt="Gerenciamento" class="card-image">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="text-warning">Gerenciamento</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>

<footer class="mt-auto">
    <?php include_once("./footer.php"); ?>
</footer>
<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
