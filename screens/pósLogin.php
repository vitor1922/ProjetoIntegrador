<?php
    include_once("../constantes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <title>Pós-Login</title>
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
            font-size: 1.8rem;
            font-weight: bold;
            color: #004A8D;
        }
        p {
            margin: 0; /* Remove a margem padrão */
            font-size: 1rem;
            font-weight: bold;
            color: #000;
        }
        .service-button {
            border-radius: 10px; /* Cantos arredondados */
            margin: 5px; /* Espaçamento entre os botões */
            display: flex;
            align-items: center; /* Centraliza o conteúdo verticalmente */
            justify-content: center; /* Centraliza o conteúdo horizontalmente */
            width: 140px; /* Largura do botão */
            height: 140px; /* Altura do botão */
            background-color: #f8f9fa; /* Cor de fundo do botão */
        }
        .service-container {
            display: flex; /* Coloca os botões lado a lado */
            justify-content: space-between; /* Espaçamento igual entre os botões */
        }
        .profile-image {
            width: 190px; /* Largura fixa da imagem */
            height: 190px; /* Altura fixa da imagem */
            object-fit: cover; /* Cobre o espaço disponível sem distorcer a imagem */
            border-radius: 50%; /* Para deixar a imagem circular */
        }
        .title-container {
            display: flex; /* Flexbox para alinhar lado a lado */
            align-items: center; /* Centraliza verticalmente */
        }
        .title {
            font-size: 3rem; /* Aumenta o tamanho do texto */
            font-weight: bold; /* Deixa o texto em negrito */
            margin-right: 40px; /* Espaçamento à direita da imagem */
            color: #004A8D;
        }
    </style>
</head>

<body>
    <?php include_once("./header.php"); ?>
    
    <main>
        <div class="container">
            <div class="row vh-100 justify-content-center align-items-stretch">
                <div class="col-md-3 border-horizontal d-flex align-items-center justify-content-center">
                    <div class="title-container d-flex align-items-center">
                        <div class="title mr-2">Salão de <br> Beleza</div>
                        <div class="image">
                        <img src="../assets/img/logoSenac.png" alt="Imagem do Salão" class="profile-image">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border-horizontal d-flex flex-column">
                    <!-- Seção de Serviços -->
                    <div class="services-title">
                        <h5 class="">Serviços</h5>
                        <button class="btn btn-link p-0" aria-label="Ver mais">
                            <img src="../src/bootstrap/bootstrap-icons/icons/arrow-right.svg" alt="Seta" width="24" height="24">
                        </button>
                    </div>
                    <div class="service-container">
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 1" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Cortes</p>
                    </div>
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 2" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Manicure & <br> Pedicure</p>
                    </div>
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Serviço 3" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Processos</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 border-horizontal d-flex flex-column">
                    <!-- Seção de Serviços -->
                    <div class="services-title">
                        <h5 class="">Instrutore e Alunos</h5>
                        <button class="btn btn-link p-0" aria-label="Ver mais">
                            <img src="../src/bootstrap/bootstrap-icons/icons/arrow-right.svg" alt="Seta" width="24" height="24">
                        </button>
                    </div>
                    <div class="service-container">
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Professor" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Prof. Nome</p>
                    </div>
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Aluno 1" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Aluno Nome</p>
                    </div>
                    <div class="service-item text-center">
                        <button class="service-button">
                            <img src="../assets/img/logoSenac.png" alt="Aluno 2" class="img-fluid" style="border-radius: 10px; width: 100%; height: 100%; object-fit: cover;">
                        </button>
                        <p>Aluno Nome</p>
                    </div>
                    </div>
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
