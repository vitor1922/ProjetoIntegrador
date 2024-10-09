<!-- J0A0 G0MES -->

<?php
include("../constantes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

</head>

<body>
    <?php
    include_once('./header.php');
    ?>
    <main>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-md-6 col-lg-5 form-container bg-light p-3 m-5 rounded-4 shadow-lg">
                <a href=""><img src="../src/bootstrap/bootstrap-icons/icons/arrow-left.svg" alt="flecha" srcset=""></a>
                <h5 class="text-start mb-3 mt-2 text-warning">Fazer Login!</h5>
                <hr class="border-warning" style="border-width: 3px;">
                <form>
                    <div class="form-group mt-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control bg-light" id="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group mt-4">
                        <label for="password">Senha</label>
                        <div class="d-flex position-relative">
                            <input type="password" class="form-control bg-light" id="password" placeholder="Digite sua senha">
                            <!-- Ícone do olho -->
                            <i class="bi bi-eye-fill position-absolute end-0 top-50 translate-middle-y me-3" id="btn-senha" style="cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-primary btn-block mt-3">Fazer Login</button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#fazerLogin">
                            Criar conta
                        </button>
                    </div>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="fazerLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content shadow-lg rounded-3">
                            <div class="modal-header d-flex justify-content-center">
                                <h1 class="modal-title text-warning fs-5" id="staticBackdropLabel">Fazer Cadastro</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body border-top border-warning">
                                <div class="col rounded">
                                    <form>
                                        <div class="form-group mt-2">
                                            <label for="firstName">Nome</label>
                                            <input type="text" class="form-control bg-light" id="firstName" placeholder="Digite seu nome">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="lastName">CPF</label>
                                            <input type="number" class="form-control bg-light" id="cpf" placeholder="Digite seu CPF">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="phone">Telefone</label>
                                            <input type="text" class="form-control bg-light" id="phone" placeholder="Digite seu telefone">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control bg-light" id="email" placeholder="Digite seu e-mail">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="password">Senha</label>
                                            <input type="password" class="form-control bg-light" id="passwordCadastro" placeholder="Digite sua senha">
                                        </div>
                                        <div class="form-group mt-2 mb-3">
                                            <label for="confirmPassword">Confirme a Senha</label>
                                            <input type="password" class="form-control bg-light" id="confirmPasswordCadastro" placeholder="Confirme sua senha">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                                <button type="button" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include("./footer.php");
    ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>