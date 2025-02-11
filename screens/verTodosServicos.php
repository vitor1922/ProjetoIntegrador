<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$servicos = [
    ["nome" => "Corte de Cabelo", "imagem" => "corte_cabelo.jpg"],
    ["nome" => "Manicure e Pedicure", "imagem" => "manicure_pedicure.jpg"],
    ["nome" => "Barba", "imagem" => "barba.jpg"],
    ["nome" => "Design de Sobrancelha", "imagem" => "sobrancelha.jpg"]
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços Disponíveis</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css" class="">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container text-center mt-4">
        <div>
        <?php
        include_once("./header.php")
        ?>
        </div>
        <h2 class="text-warning">Serviços Disponíveis</h2>
        <div class="row">
            <?php foreach ($servicos as $servico): ?>
                <div class="col-12 mb-4">
                    <div class="card">
                        <img src="<?= $servico['imagem'] ?>" class="card-img-top" alt="<?= $servico['nome'] ?>">
                        <div class="card-body">
                            <h5 class="card-title text-warning"> <?= $servico['nome'] ?> </h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php 
        include_once("./footer.php")?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>