<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
} elseif ($perfil !== "professor") {
    if ($perfil !== "admin") {
        header("Location: " . BASE_URL . "index.php");
    }
}

$sqlProfessores = "SELECT * FROM usuario WHERE perfil = 'professor'";
$selectProfessores = $conexao->prepare($sqlProfessores);
if ($selectProfessores->execute()) {
    $professores = $selectProfessores->fetchAll(PDO::FETCH_ASSOC);
}
$search = $_GET['search'] ?? '';

$query = "SELECT * FROM usuario WHERE perfil = 'professor'";
$params = [];

if ($search) {
    $query .= " AND perfil = 'professor' LIKE :search";
    $params['search'] = "%$search%";
}

$query .= " ORDER BY perfil";
$stmt = $conexao->prepare($query);
$stmt->execute($params);
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title></title>
</head>

<body class="container-fluid d-flex flex-column justify-content-between">

        <?php
        include_once("./header.php");
        ?>

        <main>
            <div class="container-fluid mt-3">
                <h1 class="text-center">Área do Serviço</h1>
                <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                    <div class="col text-end">
                        <a href="#"><i class="bi bi-chevron-left"></i></a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-7 text-center">
                        <p class="mt-3 fw-bolder fs-4 azul-senac">Gerenciamento</p>
                    </div>
                    <div class="col text-start">
                        <a href="#"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center ">
                <a href="./gerenciamentoCursos.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn   border-dark-subtle fs-7 fw-bold" type="button">CURSOS</button>
                    </a>
                    <a href="./gerenciamentoTurmas.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 fw-bold p-0 ">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">TURMAS</button>
                    </a>
                    
                    <a href="./gerenciamentoProfessores.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn btn-azul-senac text-white border-dark-subtle fs-7 fw-bold" type="button">PROFESSORES</button>
                    </a>
                </div>
                <form method="GET" class="mb-4">
                    <div class="row mb-2">
                        <div class="col-4 d-flex align-items-center">
                            <input type="text" name="search" class="col-12 text-start rounded-4 fs-7 text-black-50 text-center h-50 py-3" placeholder="Pesquisar..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                        
                        
                    </div>
                </form>
                <?php foreach ($professores as $professor): ?>
                    
                    <a href="./infoProfessor.php?id=<?=$professor["id_usuario"]?>" class="row border py-1">
                        <div class=" offset-sm-3 offset-1 col-lg-2 col-md-2 col-sm-4 col-4">
                            <img src="../foto/<?= $professor["foto"] ?>" alt="" class="img-perfil-mini">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-4 col-6 d-flex align-items-center fs-5 text-secondary text-start ">
                            <?= $professor["nome"] ?> • <?= $professor["cpf"] ?>
                        </div>
                        <div class=" col-1 p-0 bg-success ponto d-block rounded-circle align-self-center"></div>
                    </a>
                    
                <?php endforeach; ?>

                
                <!-- MODAL ADICIONAR CURSO -->
                <div class="modal fade" id="modalCadastrarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/adicionarProfessor.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">CPF do Professor</label>
                                        <input type="text" class="form-control" name="txtCpfProfessor" required>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-center">
                                        <button class="btn  btn-azul-senac  text-white fw-bold px-5" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    
    <?php
    include_once("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>