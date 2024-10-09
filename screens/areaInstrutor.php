<?php 
include_once("../constantes.php");


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Painel</title>
    <meta name="author" content="Cezar">
</head>
<body class="d-flex flex-column min-vh-100">
    <?php 
    include_once("./header.php");
    ?>

    <div class="container mt-3">
        <a href="../index.php" class="btn btn-link" style="text-decoration: none; color: inherit;">
            <i class="bi bi-arrow-left" style="font-size: 2rem; font-weight: bold;"></i> <strong style="font-size: 1.25rem;"></strong>
        </a>
    </div>

    <main class="flex-grow-1">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="./turmasProfessores.php" class="card-link" style="text-decoration: none; color: inherit;">
                        <div class="card d-flex flex-column align-items-center border-0">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSI82Gcx4qvLD41uZwxiIJvmkU9sq5p7I-u5uqKdk0I35Vh4AH8" alt="Turmas" class="card-img-top" style="height: 120px; width: 120px; object-fit: contain;" draggable="false" ondragstart="return false;" oncontextmenu="return false;">
                            <div class="card-body">
                                <h3 class="title" style="color: orange; text-align: center;">Turmas</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="./estoqueProfessor.php" class="card-link" style="text-decoration: none; color: inherit;">
                        <div class="card d-flex flex-column align-items-center border-0">
                            <img src="https://cdn-icons-png.flaticon.com/512/3121/3121768.png" alt="Estoque" class="card-img-top" style="height: 120px; width: 120px; object-fit: contain;" draggable="false" ondragstart="return false;" oncontextmenu="return false;">
                            <div class="card-body">
                                <h3 class="title" style="color: orange; text-align: center;">Estoque</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="./agendamento.php" class="Agendamentos" style="text-decoration: none; color: inherit;">
                        <div class="card d-flex flex-column align-items-center border-0">
                            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcToLzfeMFYcjlicL3YTb6y9DG85-Q19rxxdKuw0yfcP5oamMLJq" alt="Agendamentos" class="card-img-top" style="height: 120px; width: 120px; object-fit: contain;" draggable="false" ondragstart="return false;" oncontextmenu="return false;">
                            <div class="card-body">
                                <h3 class="title" style="color: orange; text-align: center;">Agendamento</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="./avaliaçõesComentarios.php" class="avaliações" style="text-decoration: none; color: inherit;">
                        <div class="card d-flex flex-column align-items-center border-0">
                            <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRVDblf9NGuc4co8nFnPEvgA_zcO2A352GquF4Rr0NtKzcBiGxe" alt="Avaliações" class="card-img-top" style="height: 120px; width: 120px; object-fit: contain;" draggable="false" ondragstart="return false;" oncontextmenu="return false;">
                            <div class="card-body">
                                <h3 class="title" style="color: orange; text-align: center;">Avaliações</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-auto">
        <?php 
            include("./footer.php");
        ?>
    </footer>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
