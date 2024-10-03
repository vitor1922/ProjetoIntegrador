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
    <style>
        .title {
            color: orange; 
            text-align: center;
            margin-top: 10px; 
        }
        .card-img-top {
            height: 120px; /* Tamanho reduzido da imagem */
            width: 100%; /* Define a largura como 100% para o preenchimento do card */
            object-fit: contain; /* Mantém a proporção da imagem */
            display: block; /* Necessário para centralização */
            margin: 0 auto; /* Centraliza a imagem */
        }
        .card-link {
            text-decoration: none; 
            color: inherit; 
        }
    </style>
    <title>Painel</title>
</head>
<body>
    <?php 
    include_once("./header.php");
    ?>
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <a href="pagina_turmas.php" class="card-link"> <!-- Link para a página de Turmas -->
                    <div class="card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSI82Gcx4qvLD41uZwxiIJvmkU9sq5p7I-u5uqKdk0I35Vh4AH8" alt="Turmas" class="card-img-top">
                        <div class="card-body">
                            <h3 class="title">Turmas</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="pagina_estoque.php" class="card-link"> 
                    <div class="card">
                        <img src="https://cdn-icons-png.flaticon.com/512/3121/3121768.png" alt="Estoque" class="card-img-top">
                        <div class="card-body">
                            <h3 class="title">Estoque</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="pagina_agendamentos.php" class="card-link"> 
                    <div class="card">
                        <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcToLzfeMFYcjlicL3YTb6y9DG85-Q19rxxdKuw0yfcP5oamMLJq" alt="Agendamentos" class="card-img-top">
                        <div class="card-body">
                            <h3 class="title">Agendamentos</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 mb-4">
                <a href="pagina_avaliacoes.php" class="card-link"> 
                    <div class="card">
                        <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRUTlUKhF9rg5b0qxYGHBqfSgH0C8vEjK8lwLFL0e10-itMegTH" alt="Avaliações" class="card-img-top">
                        <div class="card-body">
                            <h3 class="title">Avaliações</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
        include("./footer.php");
    ?>
</body>
</html>
