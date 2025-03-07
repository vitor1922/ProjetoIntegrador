<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

if (!$logado) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
} elseif ($perfil !== "professor" && $perfil !== "admin") {
    header("Location: " . BASE_URL . "index.php");
}

$search = $_GET['search'] ?? '';

$query = "SELECT * FROM curso WHERE 1=1";
$params = [];

if ($search) {
    $query .= " AND nome_do_curso LIKE :search";
    $params['search'] = "%$search%";
}

$query .= " ORDER BY nome_do_curso";
$stmt = $conexao->prepare($query);
$stmt->execute($params);
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div>
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
                        <button class="btn btn-azul-senac text-white border-dark-subtle fs-7 fw-bold" type="button">CURSOS</button>
                    </a>
                    <a href="./gerenciamentoTurmas.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 fw-bold p-0 ">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">TURMAS</button>
                    </a>

                    <a href="./gerenciamentoProfessores.php" class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">PROFESSORES</button>
                    </a>
                </div>

                <?php include_once("./header.php"); ?>
                <form method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Pesquisar..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <div class="col-md-2">
                        <?php if($perfil === "admin"){?>
                                
                                <button type="button" class="ms-2 btn btn-primary rounded btn-azul-senac" data-bs-toggle="modal" data-bs-target="#modalCadastrarCurso">Adicionar Professor</button>
                                <?php }?>
                        </div>
                    </div>
                </form>
                <div class="d-flex flex-wrap justify-content-center">
                    <?php foreach ($cursos as $curso): ?>
                        <div class="card m-2" style="width: 18rem;">
                            <img src="../foto/<?= htmlspecialchars($curso['imagem']) ?>" class="card-img-top" alt="Imagem do Curso">
                            <div class="card-body text-center">

                                <?php if ($perfil == "admin"): ?>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExcluirCurso<?= $curso['id_curso'] ?>">Excluir</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
    </div>
    <?php include_once("./footer.php"); ?>





                <div class="modal fade" id="modalCadastrarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../src/logicos/adicionarCurso.php" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nome do Curso</label>
                                        <input type="text" class="form-control" name="txtCurso" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" title="busque a url do curso no site oficial do senac">URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="txtURL" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Adicionar Imagem do Curso</label>
                                        <input type="file" name="imgCurso" class="form-control" accept="image/png, image/jpeg">
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
    </div>
    <?php
    include_once("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>