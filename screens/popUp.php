<?php
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Estética</title>
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Botão para abrir o modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Filtros
    </button>

    <main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Serviços</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Categoria 1 -->
                    <div class="categoria">
                        <div class="categoria-header" style="display: inline-flex; align-items: center; padding: 5px 10px; border: 2px solid black; border-radius: 25px; font-weight: bold; font-size: 14px;">
                            <span style="margin: 0 10px;"><i class="bi bi-arrow-left"></i> Barbearia <i class="bi bi-arrow-right"></i></span>
                        </div>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Cortes masculinos</a></p>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Barbearia</a></p>
                    </div>

                    <!-- Categoria 2 -->
                    <div class="categoria ">
                        <div class="categoria-header" style="display: inline-flex; align-items: center; padding: 5px 10px; border: 2px solid black; border-radius: 25px; font-weight: bold; font-size: 14px;">
                            <span style="margin: 0 10px;"><i class="bi bi-arrow-left"></i> Salão de Beleza <i class="bi bi-arrow-right"></i></span>
                        </div>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Processos Capilares</a></p>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Mãos e Pés</a></p>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Cabelo</a></p>
                    </div>

                    <!-- Categoria 3 -->
                    <div class="categoria">
                        <div class="categoria-header" style="display: inline-flex; align-items: center; padding: 5px 10px; border: 2px solid black; border-radius: 25px; font-weight: bold; font-size: 14px;">
                            <span style="margin: 0 10px;"><i class="bi bi-arrow-left"></i> Centro de Estética <i class="bi bi-arrow-right"></i></span>
                        </div>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Estética Corporal</a></p>
                        <p><a href="infoDeServicos.php" style="text-decoration: none; color: black;">Mãos e Pés</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
