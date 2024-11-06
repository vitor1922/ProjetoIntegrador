<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;

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
<body class="font-sans-serif">
<?php
include_once("./header.php");
?>
<div class="container mt-4">
    <div class="mb-4">
        <a href="" class="btn btn-link">
        <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
        </a>
    </div>
    <h2 class="text-center text-warning fs-2 fw-bold">Serviços Disponíveis</h2>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Corte de Cabelo</h4>
                <img src="https://www.oibonita.com.br/wp-content/uploads/2020/04/corte-degrade-feminino-33-730x889.jpg" alt="Corte de Cabelo" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Manicure e Pedicure</h4>
                <img src="https://th.bing.com/th/id/R.f4b17cd9e90d873e82a0ab12ab9da5fe?rik=%2fa3DJWvYDPZazA&pid=ImgRaw&r=0" alt="Manicure e Pedicure" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Barba</h4>
                <img src="https://www.realmenrealstyle.com/wp-content/uploads/2021/06/mens-grooming-741x505.jpg" alt="Barba" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Design de Sobrancelha</h4>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTH39j7s1memcHpCNj5cheUuhCdSCBezdpusA&s" alt="Design de Sobrancelha" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Maquiagem</h4>
                <img src="https://www.questaodebeleza.com.br/wp-content/uploads/2018/09/lehpequenomakeup_1780874163156127895.jpg" alt="Maquiagem" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Depilação</h4>
                <img src="https://th.bing.com/th/id/OIP.gP4gHuFVDoL-MGCfJhSdbQHaGi?w=1100&h=972&rs=1&pid=ImgDetMain" alt="Depilação" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Hidratação</h4>
                <img src="https://puntomarinero.com/images/sebasol-reviews-of-shampoo_3.jpg" alt="Hidratação" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow">
            <a href="./infoDeServicos.php" class="avaliacoes text-decoration-none text-dark">
                <h4 class="service-title text-warning fw-bold">Escova</h4>
                <img src="https://th.bing.com/th/id/OIP.Ib_8DGXTCjuQyeLyobhuiwHaGC?rs=1&pid=ImgDetMain" alt="Escova" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
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
