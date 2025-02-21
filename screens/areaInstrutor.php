<?php
include('../constantes.php');
include_once("../data/conexao.php");
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
    <title>Área do Instrutor</title>
    <style>
        body {
            background: #333;
            padding: 70px 0;
            font: 15px/20px Arial, sans-serif;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 1000px; /* Aumenta a largura máxima do carrossel */
            margin: auto;
            overflow: hidden;
            perspective: 1000px; /* Para o efeito 3D */
        }

        .carousel {
            position: relative;
            width: 100%;
            height: 350px; /* Aumenta a altura do carrossel */
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center; /* Centraliza os itens */
        }

        .item {
            position: absolute;
            width: 180px; /* Aumenta a largura dos cards */
            height: 250px; /* Aumenta a altura dos cards */
            border-radius: 10px;
            overflow: hidden;
            background: #fff; /* Fundo dos cards */
            transition: transform 0.5s ease, opacity 0.5s ease;
            opacity: 0.5; /* Opacidade inicial dos cards */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Adiciona sombra para efeito de profundidade */
        }

        .item img {
            width: 100%;
            height: 80%; /* Ajuste a altura da imagem no card */
            object-fit: cover; /* Para manter a proporção da imagem */
            border-radius: 10px 10px 0 0; /* Arredondar apenas o topo */
        }

        .item.active {
            opacity: 1; /* Aumentar a opacidade do card ativo */
            z-index: 1; /* Colocar o card ativo na frente */
            transform: scale(1.1); /* Aumentar o card ativo */
        }

        /* Ajustes para posicionar os cards em um círculo */
        .item:nth-child(1) { transform: rotateY(0deg) translateZ(250px); }
        .item:nth-child(2) { transform: rotateY(90deg) translateZ(250px); }
        .item:nth-child(3) { transform: rotateY(180deg) translateZ(250px); }
        .item:nth-child(4) { transform: rotateY(270deg) translateZ(250px); }

        .next,
        .prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: #CCC;
            border-radius: 5px;
            padding: 1em;
            cursor: pointer;
            box-shadow: 0 5px 0 #999;
        }

        .next:hover,
        .prev:hover {
            background: #bbb;
        }

        .next {
            right: 10px; /* Ajuste para o botão "next" */
        }

        .prev {
            left: 10px; /* Ajuste para o botão "prev" */
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .carousel {
                height: 200px; /* Altura do carrossel em mobile */
            }

            .item {
                width: 80px; /* Largura dos cards em mobile */
                height: 120px; /* Altura dos cards em mobile */
            }
        }

        @media (min-width: 769px) {
            .carousel {
                height: 350px; /* Altura do carrossel em desktop */
            }

            .item {
                width: 180px; /* Largura dos cards em desktop */
                height: 250px; /* Altura dos cards em desktop */
            }
        }
    </style>
</head>

<body class="d-flex flex-column container-fluid">
    <?php include_once("./header.php"); ?>

    <div class="mt-3">
        <a href="<?= $paginaAnterior ?>" class="btn btn-link">
            <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
        </a>
    </div>

    <div class="carousel-container">
        <div class="carousel">
            <?php
            $items = [
                ["link" => "./usuarios.php", "img" => "../assets/img/img_usuarios.png", "title" => "Usuários"],
                ["link" => "./gerenciamentoCursos.php", "img" => "../assets/img/img_gerenciamento.png", "title" => "Gerenciamento"],
                ["link" => "./controleDeEstoque.php", "img" => "../assets/img/img_estoque.png", "title" => "Estoque"],
                ["link" => "./avaliacoesComentarios.php", "img" => "../assets/img/img_avaliacoes.png", "title" => "Avaliações"],
            ];

            foreach ($items as $index => $item) {
                echo "
                    <div class='item' id='item-$index'>
                        <a href='{$item['link']}' class='text-decoration-none text-dark'>
                            <img src='{$item['img']}' alt='imagem de {$item['title']}'>
                            <h5 class='card-title fs-5 fw-bold laranja-senac'>{$item['title']}</h5>
                        </a>
                    </div>
                ";
            }
            ?>
        </div>
        <div class="next">Next</div>
        <div class="prev">Prev</div>
    </div>

    <footer class="mt-auto">
        <?php include_once("./footer.php"); ?>
    </footer>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const items = document.querySelectorAll(".item");
        let currIndex = 0;

        // Marcar o card ativo inicialmente
        items[currIndex].classList.add("active");

        // Funções para navegar no carrossel
        document.querySelector(".next").addEventListener("click", function () {
            items[currIndex].classList.remove("active");
            currIndex = (currIndex + 1) % items.length; // Próximo item
            items[currIndex].classList.add("active");
            updateCarousel();
        });

        document.querySelector(".prev").addEventListener("click", function () {
            items[currIndex].classList.remove("active");
            currIndex = (currIndex - 1 + items.length) % items.length; // Item anterior
            items[currIndex].classList.add("active");
            updateCarousel();
        });

        function updateCarousel() {
            const rotation = (currIndex * -90); // Cada item ocupa 90 graus
            document.querySelector('.carousel').style.transform = `rotateY(${rotation}deg)`;
        }
    </script>
</body>

</html>
