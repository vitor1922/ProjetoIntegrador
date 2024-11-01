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
    <title>Usuários</title>
    <meta name="author" content="Vitor Baggio">
</head>

<body>

    <?php
    include_once("./header.php");
    ?>

    <main>
        <div class="container mt-3">
            <h1 class="text-center laranja-senac">Área do Serviço</h1>
            <div class="row bg-light d-flex align-items-center w-100 w-md-50 w-lg-25 mx-auto">
                <div class="col text-end">
                    <!-- colocar paginacao aqui -->
                    <a href="#"><i class="bi bi-chevron-left "></i></a>
                </div>
                <div class="col text-center">
                    <p class="mt-3 fw-bolder azul-senac">Usuários</p>
                </div>
                <div class="col text-start">
                    <a href="#"><i class="bi-chevron-right"></i></a>
                    <!-- e aqui -->
                </div>
            </div>
            <div class="mt-4">
                <div class="row mb-2">
                    <div class="col d-flex justify-content-center align-items-center"><input type="text"
                            class="text-center rounded" placeholder="Pesquisar"></div>


                    <div class="col d-flex justify-content-end flex-column align-items-center">
                        <div class="col"></div>
                        <div class="col">
                            <p><span class="badge rounded-circle bg-danger">&nbsp;</span><strong class="text-danger">
                                    Professor</strong></p>
                            <p><span class="badge rounded-circle bg-primary">&nbsp;</span><strong class="text-primary">
                                    Aluno</strong></p>
                            <p><span class="badge rounded-circle bg-warning">&nbsp;</span><strong class="text-warning">
                                    Usuário</strong> </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-danger">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-danger">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-primary">&nbsp;</span>
                </div>
            </div>
        </div>
        <div class="container mt-0">
            <div class="card p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0"><i class="bi-person-circle"></i> Nome do Usuário • 000.000.000-00</p>
                    <span class="badge rounded-circle bg-warning">&nbsp;</span>
                </div>
            </div>
        </div>

    </main>

    <?php
    include_once("./footer.php");
    ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>