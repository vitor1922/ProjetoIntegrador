<?php 
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Aluno</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="d-flex flex-column justify-content-between">
<?php 
        include_once("./header.php");
    ?>

<main>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <a href="#"><button class="btn"><i class="bi bi-arrow-left-short" style="font-size: 25px"></i></button></a>
        <a href="#"><button class="btn"><i class="bi bi-check" style="font-size: 25px"></i></button></a>
    </div>

    <div class="text mt-4">
        <h2 class="text-warning" style="font-weight: bold;">Editar Perfil</h2>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <img src="https://inspiracabelo.com.br/wp-content/uploads/2024/03/corte-de-cabelo-para-rosto-redondo-40-anos-10.jpg" alt="Foto de perfil" class="rounded-circle" style="width: 120px;">
    </div>

    <div class="mt-4">
        <div class="mb-3">
            <label for="apelido" class="form-label">Apelido</label>
            <input type="text" id="apelido" class="form-control border-0 border-bottom" style="max-width: 350px; outline: none;">
        </div>

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" class="form-control border-0 border-bottom" style="max-width: 350px; outline: none;">
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <input type="text" id="bio" class="form-control border-0 border-bottom" style="max-width: 350px; outline: none;">
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
