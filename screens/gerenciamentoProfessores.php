<?php

session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

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

<body class="vh-100 d-flex flex-column justify-content-between">
    <div>
        <?php
        include_once("./header.php");
        ?>

        <main>
            <div class="container-fluid mt-3">
                <h1 class="text-center">Área do Serviço</h1>
                <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                    <div class="col text-end">
                        <a href="#"><i class="bi bi-chevron-left "></i></a>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-3 col-7 text-center">
                        <p class="mt-3 fw-bolder fs-4 azul-senac">gerenciamento</p>
                    </div>
                    <div class="col text-start">
                        <a href="#"><i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
                <div class="row mt-5 d-flex justify-content-center ">
                    <div class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 fw-bold p-0 ">
                        <button class="btn border-dark-subtle fs-7" type="button">TURMAS</button>
                    </div>
                    <div class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn btn-azul-senac text-white border-dark-subtle fs-7 fw-bold" type="button">CURSOS</button>
                    </div>
                    <div class=" d-grid mx-2 col-lg-1 col-sm-2 col-3 p-0">
                        <button class="btn border-dark-subtle fs-7 fw-bold" type="button">PROFESSORES</button>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="row mb-3">
                        <div class=" col-6 d-flex align-items-center ">
                            <input type="text" class="col-10 text-start rounded-4 fs-7 text-black-50 text-center h-50 py-3" value="PESQUISAR">
                            <button type="button" class="ms-2 btn btn-primary rounded btn-plus" data-bs-toggle="modal" data-bs-target="#modalCadastrarCurso">+</button>
                        </div>
                    </div>
                </div>

                <div class="row border-top border-3 py-3">
                    <div class=" offset-sm-3 offset-1 col-lg-2 col-md-2 col-4">
                        <img src="../foto/foto_DjAnCb5Fqa.jpg" alt="" class="img-curso">
                    </div>

                    <div class="col-lg-7 col-md-7 col-5 d-flex align-items-center">
                        <p class=" fs-5 text-secondary text-start">NOME DO CURSO</p>
                    </div>
                </div>


                <div class="row border-top border-3 py-3">
                    <div class=" offset-sm-3 offset-1 col-lg-2 col-md-2 col-4">
                        <img src="../foto/foto_DjAnCb5Fqa.jpg" alt="" class="img-curso">
                    </div>

                    <div class="col-lg-7 col-md-7 col-5 d-flex align-items-center">
                        <p class=" fs-5 text-secondary text-start">NOME DO CURSO</p>
                    </div>
                </div>
                <div class="row border-top border-3 py-3">
                    <div class=" offset-sm-3 offset-1 col-lg-2 col-md-2 col-4">
                        <img src="../foto/foto_DjAnCb5Fqa.jpg" alt="" class="img-curso">
                    </div>

                    <div class="col-lg-7 col-md-7 col-5 d-flex align-items-center">
                        <p class=" fs-5 text-secondary text-start">NOME DO CURSO</p>
                    </div>
                </div>
                <div class="row border-top border-3 py-3">
                    <div class=" offset-sm-3 offset-1 col-lg-2 col-md-2 col-4">
                        <img src="../foto/foto_DjAnCb5Fqa.jpg" alt="" class="img-curso">
                    </div>

                    <div class="col-lg-7 col-md-7 col-5 d-flex align-items-center">
                        <p class=" fs-5 text-secondary text-start">NOME DO CURSO</p>
                    </div>
                </div>
                <!-- MODAL ADICIONAR CURSO -->
                <div class="modal fade" id="modalCadastrarCurso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nome do Curso</label>
                                        <input type="text" class="form-control" name="txtEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" title="busque a url do curso no site oficial do senac">URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="txtEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Adicionar Imagem do Curso</label>
                                        <input type="file" class="form-control" name="txtEmail">
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