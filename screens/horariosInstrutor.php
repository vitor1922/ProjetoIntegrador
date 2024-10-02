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
            <ul class="nav nav-tabs justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">Horários</a>
                </li>
            </ul>

            <div class="d-flex justify-content-between mt-3">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="orderDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
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

            <div class="content">
                <div class="d-flex justify-content-between align-items-start py-3 border-top">
                    <div class="d-flex align-items-center">
                        <span class="user-icon">&#128100;</span>
                        <!-- <img src="https://via.placeholder.com/40" alt="Foto do Aluno X" class="me-2 rounded-circle"> -->
                        <div>
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
                        <div>
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
                        <div>
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
                        <div>
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
                        <div>
                            <p class="mb-1">Nome: <strong>Fulano de Tal</strong></p>
                            <p class="mb-1">Serviço: <strong>Serviço X</strong></p>
                        </div>
                    </div>
                    <div class="text-end">
                        <p>Turma: <strong>xx/xx/xxxx</strong></p>
                        <p class="mb-1">Aluno: <strong>Aluno X</strong></p>
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