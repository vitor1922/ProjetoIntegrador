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
                <div class="row ">
                    <div class=" col-7 d-flex align-items-center ">
                        
                        <input type="text" class="col-10 text-start rounded-4 fs-7 text-black-50 text-center h-50 py-3" value="PESQUISAR">
                        <button type="button" class="ms-2 btn btn-primary rounded btn-plus"  data-bs-toggle="modal" data-bs-target="#feedbackModal">+</button>
                    </div>
                    

                    
                        <div class="col-4 ">
                            <p class="fs-7 text-danger fw-bold"><span class="badge rounded-circle bg-danger text-danger">&nbsp;</span>
                                    Concluída</p>
                            <p class="text-primary fs-7 fw-bold"><span class="badge rounded-circle bg-primary">&nbsp;</span>Em 
                            Andamento</p>

                        </div>
                    
                </div>
            </div>

            <div class="container-fluid mt-0">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mx-auto"> idTurma • curso • ?/15 Alunos</p>
                        <span class="badge rounded-circle bg-danger">&nbsp;</span>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-0">
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mx-auto"> idTurma • curso • ?/15 Alunos</p>
                        <span class="badge rounded-circle bg-primary">&nbsp;</span>
                            </div>
                    </div>
                </div>
                <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">ID da Turma</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput">
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Nome do Curso</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="corte de c...">
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Data de Inicio</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="xx/xx/xxxx">
                                </div>
                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Data de Termino</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="xx/xx/xxxx">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label ">Alunos</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary">Enviar</button>
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