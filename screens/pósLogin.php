<?php
    include_once("../constantes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <title>Excluir Conta</title>
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .services-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .services-title h5 {
            margin: 0; /* Remove a margem padrão */
        }
        .service-button {
            border-radius: 10px; /* Cantos arredondados */
            margin: 5px; /* Espaçamento entre os botões */
            display: flex;
            align-items: center; /* Centraliza o conteúdo verticalmente */
            justify-content: center; /* Centraliza o conteúdo horizontalmente */
            width: 120px; /* Largura do botão */
            height: 120px; /* Altura do botão */
            background-color: #f8f9fa; /* Cor de fundo do botão */
        }
        .service-container {
            display: flex; /* Coloca os botões lado a lado */
            justify-content: space-between; /* Espaçamento igual entre os botões */
        }
        .profile-image {
            width: 100px; /* Largura fixa da imagem */
            height: 100px; /* Altura fixa da imagem */
            object-fit: cover; /* Cobre o espaço disponível sem distorcer a imagem */
            border-radius: 50%; /* Para deixar a imagem circular */
        }
        .title-container {
            display: flex; /* Flexbox para alinhar lado a lado */
            align-items: center; /* Centraliza verticalmente */
        }
        .title {
            font-size: 24px; /* Aumenta o tamanho do texto */
            font-weight: bold; /* Deixa o texto em negrito */
            margin-right: 15px; /* Espaçamento à direita da imagem */
        }
    </style>
</head>

<body>
    <?php include_once("./header.php"); ?>
    
    <main>
        <div class="container">
            <div class="row vh-100 justify-content-center align-items-stretch">
                <div class="col-md-3 border-horizontal d-flex align-items-center flex-column">
                    <div class="title-container">
                        <div class="title text-warning">Salão de Beleza</div>
                        <div class="image">
                            <img src="../assets/img/logoSenac.png" alt="Imagem do Salão" class="profile-image">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border-horizontal d-flex flex-column">
                    <!-- Seção de Serviços -->
                    <div class="services-title">
                        <h5 class="text-start text-warning">Serviços</h5>
                        <button class="btn btn-link p-0" aria-label="Ver mais">
                            <img src="../src/bootstrap/bootstrap-icons/icons/arrow-right.svg" alt="Seta" width="24" height="24">
                        </button>
                    </div>
                    <div class="service-container">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 1" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 2" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 3" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                    </div>
                </div>
                <div class="col-md-3 border-horizontal d-flex flex-column">
                    <h5 class="text-warning">Ajuda</h5>
                    <p>Se precisar de ajuda, entre em contato com o suporte.</p>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="#">Termos de Serviço</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const confirmButton = document.getElementById('confirmButton');
        const deleteForm = document.getElementById('deleteForm');
        
        confirmButton.addEventListener('click', function() {
            deleteForm.submit(); // Envia o formulário após confirmação
        });
    </script>
    <?php include_once("./footer.php"); ?>
</body>

</html>
