<?php
session_start(); // Inicia a sessão para capturar o nome do instrutor
include('../constantes.php');
include_once("../data/conexao.php");


$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;
$nome = $_SESSION['nome'] ?? NULL;

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: ./signUp.php");
    exit();
}

// Simulação de nome do instrutor (remova se já estiver implementado na sessão)
$nomeInstrutor = $nome ?? 'Instrutor';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
 
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap" rel="stylesheet"> <!-- Fonte adicionada -->
    <title>Área do Instrutor</title>
    <style>
        * {
            font-family: "Roboto", Helvetica, sans-serif;
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.8));
            /* Degradê de preto sólido para um preto mais claro na parte inferior */
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: #0A0617;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .logo {
            width: 150px;
            /* Ajuste o tamanho conforme necessário */
            animation: pulse 1s infinite;
            /* Animação de pulsar */
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .header-container {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .title {
            font-family: 'Roboto Slab', serif;
            /* Altera a fonte para Roboto Slab */
            color: white;
            font-size: 32px;
            font-weight: bold;
            margin-top: 120px;
            text-align: center;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeIn 1s ease-out forwards;
        }

        .welcome-message {
            color: white;
            font-size: 20px;
            margin-top: 10px;
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards 0.5s;
        }

        .content {
            margin-top: 20px;
            margin-bottom: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards 1s;
            /* Atraso para a animação da content */
        }

        .divider {
            width: 80%;
            height: 2px;
            margin: 20px 0;
            border-radius: 10px;
        }

        .card-group {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }

        .card {
            width: 225px;
            height: 400px;
            border-radius: 20px;
            /* Bordas arredondadas */
            /* Gradiente de fundo */
            /* Sombra */
            overflow: hidden;
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
            /* Transição suave */
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            /* Efeito de levantar o card */
            /* Aumenta a sombra no hover */
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(40px);
                /* Mover para baixo inicialmente */
            }

            to {
                opacity: 1;
                transform: translateY(0);
                /* Mover para a posição original */
            }
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            transition: 0.5s;
        }

        .card .layer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 75%;
            opacity: 0;
            transition: 0.3s;
        }

        .card .info {
            color: white;
            position: absolute;
            bottom: -50%;
            padding: 15px;
            opacity: 0;
            transition: 0.5s bottom, 1.75s opacity;
        }

        .info p {
            font-size: 14px;
            margin-top: 3px;
        }

        .info h1 {
            font-size: 30px;
            margin-top: 3px;
        }

        .info button {
            background: #490CCC;
            border: none;
            padding: 8px 12px;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 8px;
            color: white;
            cursor: pointer;
        }

        .card:hover,
        .card:hover img,
        .card:hover .layer {
            transform: scale(1.1);
        }

        .card:hover>.layer {
            opacity: 1;
        }

        .card:hover>.info {
            bottom: 0;
            opacity: 1;
        }

        .card-group:hover>.card:not(:hover) {
            filter: blur(5px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0 ">
    <?php include_once("./header.php") ?>
    <div class="preloader" id="preloader">
        <img src="../assets/img/senac_logo_branco.png" class="logo" alt="Logo do Senac"> <!-- Substitua pelo caminho correto da logo -->
    </div>

    <h1 class="title">Área do Instrutor</h1>
    <p class="welcome-message">Olá, <?= $nomeInstrutor  ?>! Bem-vindo de volta.</p>

    <div class="divider"></div> <!-- Divisor estilizado -->
    <a href="<?= $_SERVER['HTTP_REFERER'] ?? 'index.php' ?>" class="bi bi-arrow-left fs-3 m-5"></i></a>
    <div class="content">
        <div class="card-group">
            <div class="card">
                <img src="../assets/img/Usuarios.png" class="img-fluid" alt="Gerenciamento de Usuários">
                <div class="layer"></div>
                <div class="info">
                    <h1 class="text-black">Usuários</h1>
                    <p class="text-black">Gerencie os usuários da plataforma de forma simples e eficiente.</p>
                    <a href="./usuarios.php"><button aria-label="Gerenciar usuários">Ver Usuários</button></a>
                </div>
            </div>
            <div class="card">
                <img src="../assets/img/Avalicoes.png" class="img-fluid" alt="Gerenciamento de Usuários">
                <div class="layer"></div>
                <div class="info">
                    <h1 class="text-black">Agendamentos</h1>
                    <p class="text-black">Gerencie os agendamentos da plataforma de forma simples e eficiente.</p>
                    <a href="./horariosInstrutor.php"><button aria-label="Gerenciar agendamentos">Ver Agendamentos</button></a>
                </div>
            </div>
            <div class="card">
                <img src="../assets/img/Gerenciamento.png" class="img-fluid" alt="Gerenciamento de Cursos">
                <div class="layer"></div>
                <div class="info">
                    <h1 class="text-black">Gerenciamento</h1>
                    <p class="text-black">Controle cursos, horários e outros aspectos administrativos.</p>
                    <a href="./gerenciamentoCursos.php"><button aria-label="Gerenciar cursos">Gerenciar</button></a>
                </div>
            </div>
            <div class="card">
                <img src="../assets/img/Estoque.png" class="img-fluid" alt="Controle de Estoque">
                <div class="layer"></div>
                <div class="info">
                    <h1 class="text-black">Ver Estoque</h1>
                    <p class="text-black">Monitore e organize o estoque de produtos e materiais.</p>
                    <a href="./estoqueProfessor.php"><button aria-label="Gerenciar estoque">Explore</button></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                document.getElementById("preloader").style.display = "none";
            }, 1500); // Tempo do preloader

            // Animações dos cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 1500 + index * 500); // Atraso aumentado para cada card
            });
        };
    </script>

</body>

</html>