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
unset($conexao);
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
                    <div class="row mb-2">
                        <div class="col-4 d-flex align-items-center">
                            <input type="text" name="search" class="col-12 text-start rounded-4 fs-7 text-black-50 text-center h-50 py-3" placeholder="Pesquisar..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <?php if($perfil === "admin"){?>
                            <div class="col-md-2 pt-2">
                                <button type="button" class="ms-2 btn btn-primary btn-azul-senac" data-bs-toggle="modal" data-bs-target="#modalCadastrarCurso">Adicionar Curso</button>
                            </div>
                        <?php }?>
                        
                    </div>
                </form>

<?php foreach ($cursos as $curso): ?>
    <div class="d-flex pt-4 "> 
                        <a href="./infoCurso.php?id=<?= $curso["id_curso"] ?>" class="soffset-sm-3 offset-1 col-lg-4 col-md-4 col-sm-4 col-4 row-4">
                            <img src="../foto/<?= $curso["imagem"] ?>" alt="" class="offset-sm-3 offset-1 col-lg-4s col-md-4 col-sm-4 col-4 row-4">
                        </a>
                        <a href="./infoCurso.php?id=<?= $curso["id_curso"] ?>" class="col-lg-4 col-md-4 col-sm-2 col-4 d-flex align-items-center text-decoration-none">
                            <p class="fs-5 text-secondary text-start"><?= $curso["nome_do_curso"] ?></p>
                        </a>
                        <?php if($perfil === "admin"){?>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1 d-flex align-items-center">
                            <div class="col-1 d-flex justify-content-start">
                                <button class="btn text-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalExcluirCurso<?= $curso["id_curso"] ?>">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </div>
                        <?php }?>
                        <div class="modal fade" id="modalExcluirCurso<?= $curso["id_curso"] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../src/logicos/excluirCurso.php" method="POST">
                                            <input type="hidden" name="id_curso" value="<?= $curso["id_curso"] ?>">
                                            <p class="text-center">Tem certeza que deseja excluir o curso <strong><?= $curso["nome_do_curso"] ?></strong>?</p>
                                            <div class="mb-3 d-flex justify-content-center">
                                                <button class="btn btn-danger text-white fw-bold px-5" type="submit">EXCLUIR</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>
<?php endforeach; ?>
    </div>
    

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
    
    <?php
    include_once("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>