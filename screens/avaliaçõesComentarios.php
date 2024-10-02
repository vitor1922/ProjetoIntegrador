<?php 
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Instrutor</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    
    <?php 
    include_once("./header.php"); 
    ?>

    <main class="container mt-3 flex-grow-1">
        <h3 class="text-center">Área do Instrutor</h3>
        <div class="text-center">
        <hr class="flex-grow-1">
            <span class="mx-2"><i class="bi bi-chevron-compact-left"></i> Avaliações <i class="bi bi-chevron-compact-right"></i></span>
            <hr class="flex-grow-1">
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
            <div>
                <!-- usar o ORDER BY p filtrar seus  -->
                <span>Ordenar Por:</span>
                <button class="btn btn-link">por turma</button>
                <button class="btn btn-link">mais recente</button>
                <button class="btn btn-link">mais antigo</button>
                <?php 
                include_once("./popUpThalles.php");
                ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png" alt="Icone Usuario" width="50" class="me-3">
                        <div>
                            <h5>Nome</h5>
                            <p class="mb-0">Serviço - Turma xx/xx/xxxx</p>
                        </div>
                    </div>
                    <div>
                        <span>Nome do Aluno</span>
                        <div>4.0</div>
                    </div>
                </div>
                <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec nunc efficitur lacus imperdiet ullamcorper. In dignissim ipsum est, sit amet convallis ligula posuere vitae.</p>
            </div>
        </div>
    </main>

    <footer class="bg-light text-center py-3 mt-auto">
        <?php include_once("./footer.php"); ?>
    </footer>
    
</body>
</html>
