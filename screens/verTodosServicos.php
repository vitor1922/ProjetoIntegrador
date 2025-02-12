<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

// Consulta ao banco de dados
$sql = "SELECT nome_do_curso, imagem FROM curso"; // Ajuste a tabela e campos conforme seu banco de dados
$result = $conexao->query($sql);

// Verifica se a consulta retornou resultados
if ($result > 0) {
    // Cria um array para armazenar os dados
    $cursos = [];

    // Loop para buscar os dados e armazená-los no array
    while ($row = $result->fetch_assoc()) {
        $cursos[] = [
            "nome" => $row["nome_do_curso"],
            "imagem" => $row["imagem"]
        ];
    }
} else {
    echo "Nenhum curso encontrado.";
}

?>

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços Disponíveis</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">
    <?php
    include_once("./header.php");
    ?>
    <main class="d-flex justify-content-center align-items-center ">
        <div class="container text-center mt-4">
            <h2 class="text-warning">Serviços Disponíveis</h2>
            <div class="row">
                <?php foreach ($cursos as $curso): ?>
                    <div class="col-12 col-md-3 mb-4">
                        <div class="card">
                            <img src="<?= $curso['imagem'] ?>" class="card-img-top" alt="<?= $curso['nome'] ?>">
                            <div class="card-body">
                                <h5 class="card-title text-warning"> <?= $curso['nome'] ?> </h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php include_once("./footer.php"); ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>