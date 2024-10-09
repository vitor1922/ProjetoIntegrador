<?php
include_once("../constantes.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Horários - Instrutor</title>
</head>

<body>

    <?php
    include_once("./header.php");
    ?>

    <main>
        <div class="container mt-3">
            <h4 class="text-center">Área do Instrutor</h4>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col-auto">
                    <!-- colocar paginacao aqui -->
                    <a href="#"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder">Agendamentos</p>
                </div>
                <div class="col-auto">
                    <a href="#"><i class="bi bi-chevron-right"></i></a>
                    <!-- e aqui -->
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-between mt-3">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="orderDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Ordenar Por:
                </button>
                <ul class="dropdown-menu" aria-labelledby="orderDropdown">
                    <li><a class="dropdown-item" href="/?filtro=mais-novo">Mais Novo</a></li>
                    <li><a class="dropdown-item" href="/?filtro=mais-antigo">Mais Antigo</a></li>
                </ul>
            </div>

            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="filterDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Filtros:
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="/?filtro=por-turma">Por Turma</a></li>
                    <li><a class="dropdown-item" href="/?filtro=por-servico">Por Serviço</a></li>
                </ul>
            </div>
        </div>


        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
        <!-- <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start py-3 border-top">
                    <div class="d-flex align-items-center">
                        <span class="user-icon">&#128100;</span>
                        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
        <!-- <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start py-3 border-top">
                    <div class="d-flex align-items-center">
                        <span class="user-icon">&#128100;</span> -->
        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
        <!-- <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start py-3 border-top">
                    <div class="d-flex align-items-center">
                        <span class="user-icon">&#128100;</span>
                        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
        <!-- <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
                    </div>
                </div> -->
        <!-- <div class="d-flex justify-content-between align-items-start py-3 border-top">
                    <div class="d-flex align-items-center">
                        <span class="user-icon">&#128100;</span> -->
        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
        <!-- <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div> -->
        <!-- <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
                    </div>
                </div> -->


        <div class="d-grid col-lg-8 text-start offset-1 me-5 mb-3">
            <button class="btn shadow-sm btn-cinza" data-bs-toggle="modal"">
                    <div class=" d-flex justify-content-between align-items-start py-3 border-top">
                <div class="d-flex align-items-center">
                    <span class="user-icon">&#128100;</span>
                    <div class="row text-start ">
                        <div class="  col-10 ">
                            <div class="row">
                                <div class="col-12">
                                    <p class="p-0 m-0 fw-bold ">Nome:</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="p-0 m-0">Juanito de la Peste</p>
                                </div>
                            </div>
                        </div>
                        <span class="user-icon">&#128100;</span>
                        <div class="row text-start ">
                        <div class="  col-10 ">
                        <div class="row">
                            <div class="col-15">
                                <p class="p-0 m-0 fw-bold ">Nome:</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="p-0 m-0">Juanito de la Peste</p>
                            </div>
                        </div>
                    </div>
                        </div>
                       

                </div>
        </div>
        </div>
        
    </main>

    <?php
    include_once("./footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>