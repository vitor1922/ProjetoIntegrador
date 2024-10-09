<?php 
include_once("../constantes.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
    <meta name="author" content="Cezar">
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
        <span>Avaliações</span>
    </div>

    <div class="d-flex flex-column align-items-center mt-3">
        <div class="d-flex align-items-center">
            <span>Ordenar Por:</span>
            <button class="btn btn-link mx-2">Por turma</button>
            <span>|</span>
            <button class="btn btn-link mx-2">Mais recente</button>
            <span>|</span>
            <button class="btn btn-link mx-2">Mais antigo</button>
        </div>
        
        <div class="mt-3">
            <?php include_once("./popUpThalles.php")?>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png" alt="Ícone Usuário" width="50" class="me-3">
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
            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec nunc efficitur lacus imperdiet ullamcorper. In dignissim ipsum est, sit amet convallis ligula posuere vitae. Aliquam bibendum, tellus vitae hendrerit laoreet, orci felis aliquet.</p>
            <a href="#">ler mais...</a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png" alt="Ícone Usuário" width="50" class="me-3">
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
            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec nunc efficitur lacus imperdiet ullamcorper. In dignissim ipsum est, sit amet convallis ligula posuere vitae. Aliquam bibendum, tellus vitae hendrerit laoreet, orci felis aliquet.</p>
            <a href="#">ler mais...</a>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png" alt="Ícone Usuário" width="50" class="me-3">
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
            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec nunc efficitur lacus imperdiet ullamcorper. In dignissim ipsum est, sit amet convallis ligula posuere vitae. Aliquam bibendum, tellus vitae hendrerit laoreet, orci felis aliquet.</p>
            <a href="#">ler mais...</a>
        </div>
    </div>
</main>

<footer>
    <?php
    include_once("./footer.php"); 
    ?>
</footer>
</body>
</html>
