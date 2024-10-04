<?php 
include_once("../constantes.php")
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
<title>Serviços Disponíveis</title>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .service-card {
            text-align: center;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .service-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
        }
        .service-title {
            color: orange;
            font-weight: bold;
            margin: 10px 0;
        }
</style>
</head>
<body>
<!-- Cabeçalho com o logo e ícones -->
<?php 
include_once("./header.php");
?>

    <!-- Título -->
<div class="container mt-4">
<h3 class="text-center" style="color: orange;">Serviços Disponíveis</h3>
</div>

    <!-- Cards de serviços -->
<div class="container">
<div class="row justify-content-center">
<!-- Corte de Cabelo -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliaçõesComentarios.php" class="avaliações" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Corte de Cabelo</h4>
<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTTDtPjaS8AhK7olTWzd9UncKc4KgpMgPrwfyWE0deuwqlR_vSE" alt="Corte de Cabelo">
</div>

            <!-- Manicure e Pedicure -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliaçõesComentarios.php" class="avaliações" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Manicure e Pedicure</h4>
<img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS1jyIlg_LKhEcpajds4cjDtl3r7Wi7j8RVvWeKIAyqkzyH9ZqZ" alt="Manicure e Pedicure">
</div>

            <!-- Barba -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliaçõesComentarios.php" class="avaliações" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Barba</h4>
<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQyDwg1puNLwVU1n_FiE85VmoMwM2Zi4OlZ-2jhAhoJa04LRvOv" alt="Barba">
</div>

            <!-- Design de Sobrancelha -->
<div class="col-12 col-md-6 col-lg-4 service-card">
<a href="./avaliaçõesComentarios.php" class="avaliações" style="text-decoration: none; color: inherit;">
<h4 class="service-title">Design de Sobrancelha</h4>
<img src="data:image/jpeg;base64,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" alt="Design de Sobrancelha">
</div>
</div>
</div>

<footer>
<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include_once("./footer.php");?>
</footer>
</body>
</html>