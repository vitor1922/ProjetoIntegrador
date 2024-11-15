<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;

$servicosDisponiveis = [
    'Corte de Cabelo' => true,
    'Manicure e Pedicure' => false,
    'Barba' => true,
    'Design de Sobrancelha' => false,
    'Maquiagem' => false,
    'Depilação' => true,
    'Hidratação' => true,
    'Escova' => false,
];
$paginaAnterior = $_SERVER['HTTP_REFERER'] ?? BASE_URL . "index.php";
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
<body>
<?php include_once("./header.php"); ?>

<div class="container-fluid mt-4">
    <div class="mb-4">
        <a href="<?=$paginaAnterior?>" class="btn btn-link">
            <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i>
        </a>
    </div>
    <h2 class="text-center text-warning fs-2 fw-bold">Serviços Disponíveis</h2>
    <div class="row justify-content-center mt-4">
        <?php
        
        $servicos = [
            ['nome' => 'Corte de Cabelo', 'img' => 'https://www.oibonita.com.br/wp-content/uploads/2020/04/corte-degrade-feminino-33-730x889.jpg'],
            ['nome' => 'Manicure e Pedicure', 'img' => 'https://th.bing.com/th/id/R.f4b17cd9e90d873e82a0ab12ab9da5fe?rik=%2fa3DJWvYDPZazA&pid=ImgRaw&r=0'],
            ['nome' => 'Barba', 'img' => 'https://www.realmenrealstyle.com/wp-content/uploads/2021/06/mens-grooming-741x505.jpg'],
            ['nome' => 'Design de Sobrancelha', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTH39j7s1memcHpCNj5cheUuhCdSCBezdpusA&s'],
            ['nome' => 'Maquiagem', 'img' => 'https://www.questaodebeleza.com.br/wp-content/uploads/2018/09/lehpequenomakeup_1780874163156127895.jpg'],
            ['nome' => 'Depilação', 'img' => 'https://th.bing.com/th/id/OIP.gP4gHuFVDoL-MGCfJhSdbQHaGi?w=1100&h=972&rs=1&pid=ImgDetMain'],
            ['nome' => 'Hidratação', 'img' => 'https://puntomarinero.com/images/sebasol-reviews-of-shampoo_3.jpg'],
            ['nome' => 'Escova', 'img' => 'https://th.bing.com/th/id/OIP.Ib_8DGXTCjuQyeLyobhuiwHaGC?rs=1&pid=ImgDetMain']
        ];

        foreach ($servicos as $servico) {
            $nome = $servico['nome'];
            $img = $servico['img'];
            $disponivel = $servicosDisponiveis[$nome] ?? false;


            $cardClass = $disponivel ? '' : 'indisponivel';
            $imgStyle = $disponivel ? '' : 'filter: grayscale(100%); opacity: 0.6;';
            $linkClass = $disponivel ? 'text-dark' : 'text-muted';
            $pointerEvents = $disponivel ? '' : 'pointer-events: none;';

            $link = $disponivel ? "agendamento.php?servico=" . urlencode($nome) : "#";
        ?>
        <div class="col-md-6 col-lg-4 service-card text-center p-3 mb-4 shadow <?= $cardClass ?>" style="<?= $pointerEvents ?>">
            <a href="<?= $link ?>" class="avaliacoes text-decoration-none <?= $linkClass ?>">
                <h4 class="service-title text-warning fw-bold"><?= $nome ?></h4>
                <img src="<?= $img ?>" alt="<?= $nome ?>" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover; <?= $imgStyle ?>">
            </a>
        </div>
        <?php } ?>
    </div>
</div>

<?php include_once("./footer.php"); ?>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
