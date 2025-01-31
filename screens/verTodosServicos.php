<?php
session_start();
include_once("./constantes.php");
include_once('./data/conexao.php');

$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;

// Consulta no banco de dados (exemplo):
$query = "SELECT nome, imagem, disponivel FROM servicos";
$result = $conn->query($query);

$servicos = [];
while ($row = $result->fetch_assoc()) {
    $servicos[] = $row;
}

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
        <?php foreach ($servicos as $servico) { 
            $nome = $servico['nome'];
            $img = $servico['imagem'];
            $disponivel = $servico['disponivel'];
            
            $cardClass = $disponivel ? '' : 'indisponivel';
            $linkClass = $disponivel ? 'text-dark' : 'text-muted';
            $link = $disponivel ? "agendamento.php?servico=" . urlencode($nome) : "#";
        ?>
        <div class="col-12 col-sm-6 col-md-4 service-card text-center p-3 mb-4 shadow <?= $cardClass ?>">
            <a href="<?= $link ?>" class="avaliacoes text-decoration-none <?= $linkClass ?>">
                <h4 class="service-title text-warning fw-bold"><?= $nome ?></h4>
                <img src="<?= $img ?>" alt="<?= $nome ?>" class="img-fluid" style="width: 100%; height: 250px; object-fit: cover;">
            </a>
        </div>
        <?php } ?>
    </div>
</div>

<?php include_once("./footer.php"); ?>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
