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
                <div class="col-auto">
                    <a href="#"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder">gerenciamento</p>
                </div>
                <div class="col-auto">
                    <a href="#"><i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col d-flex w-25 p-3 h-75 p-3 justify-content-center ">
                        <input type="text" class="text-start w-75 p-3 rounded" placeholder="Pesquisar">
                    </div>
                    <button type="button" class="btn btn-primary rounded mt-3 btn-plus"  data-toggle="modal" data-target="#feedbackModal">+</button>
                    <div class="col d-flex justify-content-end flex-column align-items-center">
                        <div class="col">
                            <p><span class="badge rounded-circle bg-danger">&nbsp;</span><strong class="text-danger">
                                    concluida</strong></p>
                            <p><span class="badge rounded-circle bg-primary">&nbsp;</span><strong class="text-primary">
                                    agendamento</strong></p>

                        </div>
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
                        <span class="badge rounded-circle bg-primary">&nbsp;</span
                            </div>
                    </div>
                </div>
                <div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Avalie sua experiência</h5>
                            </div>
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>