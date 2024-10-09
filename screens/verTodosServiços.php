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
    <title>Serviços Disponíveis</title>
</head>
<body style="font-family: Arial, sans-serif;">
<?php
include_once("./header.php");
?>
<div class="container mt-4">
    <div class="mb-4">
        <a href="" class="btn btn-link">
            <i class="bi bi-arrow-left" style="font-size: 1.5rem; color: black;"></i></a>
    </div>
    <h2 class="text-center" style="color: orange; font-size: 1.75rem;">Serviços Disponíveis</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Corte de Cabelo</h4>
                <img src="https://www.oibonita.com.br/wp-content/uploads/2020/04/corte-degrade-feminino-33-730x889.jpg" alt="Corte de Cabelo" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Manicure e Pedicure</h4>
                <img src="https://th.bing.com/th/id/R.f4b17cd9e90d873e82a0ab12ab9da5fe?rik=%2fa3DJWvYDPZazA&pid=ImgRaw&r=0" alt="Manicure e Pedicure" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Barba</h4>
                <img src="https://www.realmenrealstyle.com/wp-content/uploads/2021/06/mens-grooming-741x505.jpg" alt="Barba" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Design de Sobrancelha</h4>
                <img src="https://studioandreaaronne.com.br/wp-content/uploads/2023/07/Design-de-Sobrancelhas-Premium-Miniatura-FEED-2.png" alt="Design de Sobrancelha" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Maquiagem</h4>
                <img src="https://www.questaodebeleza.com.br/wp-content/uploads/2018/09/lehpequenomakeup_1780874163156127895.jpg" alt="Maquiagem" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Depilação</h4>
                <img src="https://th.bing.com/th/id/OIP.gP4gHuFVDoL-MGCfJhSdbQHaGi?w=1100&h=972&rs=1&pid=ImgDetMain" alt="Depilação" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Hidratação</h4>
                <img src="https://puntomarinero.com/images/sebasol-reviews-of-shampoo_3.jpg" alt="Hidratação" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center rounded p-3 mb-4">
            <a href="./infoDeServicos.php" class="avaliacoes" style="text-decoration: none; color: inherit;">
                <h4 class="service-title" style="color: orange; font-weight: bold;">Escova</h4>
                <img src="https://th.bing.com/th/id/OIP.Ib_8DGXTCjuQyeLyobhuiwHaGC?rs=1&pid=ImgDetMain" alt="Escova" class="img-fluid rounded" style="width: 100%; height: 250px; object-fit: cover; border-radius: 5px;">
            </a>
        </div>
    </div>
</div>
<?php
include_once("./footer.php");
?>
<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
