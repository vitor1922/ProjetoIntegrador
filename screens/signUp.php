<!-- J0A0 G0MES -->

<?php
session_start();
include("../constantes.php");
$mensagem = $_SESSION['mensagem'] ?? null;
$_SESSION['mensagem'] = null;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="J0A0 GOMES">
    <title>Document</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

</head>

<body class="vh-100">
    <?php
    include_once('./header.php');
    ?>
    <main class=" h-75 d-flex">
        <div class="container form-container d-flex justify-content-center align-items-center">
            <div class="col-10 col-md-6 col-lg-6 bg-light p-3 rounded-4 shadow-lg">
                <a class=" link-underline-opacity-0" href=""><i class="bi bi-arrow-left text-dark fs-4"></i></a>
                <h5 class="text-start mb-3 mt-2 text-warning">Fazer Login!</h5>
                <hr class="border-warning" style="border-width: 3px;">
                <form action="../src/logicos/autenticar.php" method="POST">
                    <div class="form-group mt-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control bg-light" id="email" name="txtEmail" aria-describedby="emailHelp" placeholder="Digite seu e-mail">
                    </div>
                    <div class="form-group mt-4">
                        <label for="password">Senha</label>
                        <div class="d-flex position-relative">
                            <input type="password" class="form-control bg-warning-subtle" id="passwordInput" name="txtSenha" placeholder="Digite sua senha">
                            <!-- Ícone do olho -->
                            <i class="bi-eye-fill text-start position-absolute end-0 top-50 translate-middle-y me-3" id="iconPassword" onclick="viewSenha()" style="cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block mt-3">Fazer Login</button>
                </form>
                <!-- Button trigger modal -->

                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#fazerLogin">
                    Criar conta
                </button>
            </div>

            <?php if (isset($mensagem)) { ?>
                <p class="alert alert-warning mt-2">
                    <?= $mensagem ?>
                </p>
            <?php } ?>

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
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control bg-light" id="cpf" placeholder="Digite seu CPF">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control bg-light" id="phone" placeholder="Digite seu telefone">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control bg-light" id="email" name="txtEmail" placeholder="Digite seu e-mail">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control bg-light" id="passwordCadastro" name="txtSenha" placeholder="Digite sua senha">
                                    </div>
                                    <div class="form-group mt-2 mb-3">
                                        <label for="confirmPassword">Confirme a Senha</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control bg-warning-subtle border-right-0" id="inputConfirmPass" placeholder="Confirme sua senha">
                                            <div class="input-group-text border-left-0">
                                                <i class="bi-eye-fill" id="icontogleConfirmPass" onclick="viewSenha()" style="cursor: pointer;"></i>
                                            </div>
                                        </div>
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