<!-- J0A0 G0MES -->

<?php
session_start();
include("../constantes.php");
include_once('../data/conexao.php');

$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? FALSE;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
$_SESSION['logado'] = FALSE;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cep = preg_replace('/[^0-9]/', '', $_POST['txtCep']); // Limpa o CEP, mantendo apenas números

    if (strlen($cep) === 8) { // Verifica se o CEP tem 8 dígitos
        $url = "https://viacep.com.br/ws/$cep/json/";

        // Inicializa a sessão cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decodifica a resposta JSON
        $data = json_decode($response, true);

        if (isset($data['erro']) && $data['erro'] === true) {
            $mensagem = "CEP inválido!";
        } else {
            // Exibe os dados do endereço
            $logradouro = $data['logradouro'] ?? 'Não disponível';
            $bairro = $data['bairro'] ?? 'Não disponível';
            $cidade = $data['localidade'] ?? 'Não disponível';
            $estado = $data['uf'] ?? 'Não disponível';
        }
    } else {
        $mensagem = "CEP inválido! Por favor, insira um CEP com 8 dígitos.";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="J0A0 GOMES">
    <title>Faça login</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="container-fluid min-vh-100 d-flex flex-column">
    <?php include_once('./header.php'); ?>

    <main class="d-flex align-items-center flex-grow-1 p-3">
        <div class="container form-container d-flex justify-content-center align-items-center flex-grow-1">
            <div class="col-10 col-md-6 col-lg-6 bg-light p-3 rounded-4 shadow-lg">
                <h5 class="text-center mb-3 mt-2 text-warning">Fazer Login</h5>
                <hr class="border-warning" style="border-width: 3px;">
                <form action="../src/logicos/autenticar.php" method="POST">
                    <div class="form-group mt-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control bg-light" id="email" name="txtEmail" aria-describedby="emailHelp" placeholder="Digite seu e-mail" required>
                    </div>
                    <div class="form-group mb-3 mt-4">
                        <label for="password">Senha</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control bg-warning-subtle border-right-0" id="passwordInput" name="txtSenha" placeholder="Digite sua senha" required>
                            <div class="input-group-text border-left-0">
                                <i class="bi-eye-fill text-start" id="iconPassword" onclick="viewSenha()"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalRecuperacao">
                            Esqueceu a senha?
                        </button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Fazer Login</button>
                    </div>
                </form>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#fazerCadastro"> Criar conta </button>
                <?php include("./recuperarSenha.php"); ?>
            </div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert alert-warning mt-2">
                    <?= $mensagem ?>
                </p>
            <?php } ?>
        </div>
    </main>

    <?php include("./footer.php"); ?>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/js/script.js"></script>
    <script src="../src/js/cep.js"></script>
</body>
</html>