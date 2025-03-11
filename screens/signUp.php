<!-- J0A0 G0MES -->

<?php
session_start();
include("../constantes.php");
include_once('../data/conexao.php');

$logado = $_SESSION['logado'] ?? NULL;

// $_SESSION['logado'] = FALSE;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil = $_SESSION['perfil'] ?? NULL;
$_SESSION['mensagem'] = NULL;


// Recupera os valores do formulário da sessão, se existirem
$formData = $_SESSION['formulario'] ?? []; // Limpa a sessão após recuperar os dados
unset($_SESSION['formulario']);

$emailCadastrado = $_SESSION['email_cadastrado'] ?? '';
unset($_SESSION['email_cadastrado']);

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
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
</head>

<body class="d-flex justify-content-between flex-column min-vh-100 p-0">
    <?php
    include_once('./header.php');
    ?>
    <main class="d-flex justify-content-center align-items-center ">
        <div class=" container form-container d-flex justify-content-center align-items-center">
            <div class="col-10 col-md-6 col-lg-6 bg-light p-3 rounded-4 shadow-lg">
                <h5 class="text-center mb-3 mt-2 text-warning">Fazer Login</h5>
                <hr class="border-warning" style="border-width: 3px;">
                <form action="../src/logicos/autenticar.php" method="POST">
                    <div class="form-group mt-4">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control bg-light" id="email" name="txtEmail" aria-describedby="emailHelp" placeholder="Digite seu e-mail" required value="<?= htmlspecialchars($emailCadastrado ?? '') ?>">
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
                        <a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalRecuperacao">
                            Esqueceu a senha?
                        </a>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Fazer Login</button>
                </form>
                <div class="modal fade" id="modalRecuperacao" tabindex="-1" aria-labelledby="modalRecuperacaoLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalRecuperacaoLabel"> Recuperação de Senha </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <p>Digite seu e-mail para recuperar sua senha.</p>
                                <form action="../src/logicos/logicaSenhaRedfinir.php" method="POST">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar Link de Recuperação</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#fazerCadastro"> Criar conta </button>
            </div>
            <?php if (isset($mensagem)) { ?>
                <p class="alert alert-warning mt-2">
                    <?= $mensagem ?>
                </p>
            <?php } ?>

            <!-- Modal -->
            <div class="modal fade" id="fazerCadastro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content shadow-lg rounded-3">
                        <div class="modal-header d-flex justify-content-center">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body border-top border-warning">
                            <div class="col rounded">
                                <h5 class="text-center mb-3 mt-2 text-warning">Fazer Cadastro</h5>
                                <form action="../src/logicos/cadUsuario.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 form-group mt-2">
                                            <label for="genero">Gênero</label>
                                            <select class="form-control bg-light" id="genero" name="txtGenero" required>
                                                <option value="">Selecione</option>
                                                <option value="Masculino" <?= (isset($formData['txtGenero']) && $formData['txtGenero'] == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                                                <option value="Feminino" <?= (isset($formData['txtGenero']) && $formData['txtGenero'] == 'Feminino') ? 'selected' : '' ?>>Feminino</option>
                                                <option value="Outro" <?= (isset($formData['txtGenero']) && $formData['txtGenero'] == 'Outro') ? 'selected' : '' ?>>Outro</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="firstName">Nome</label>
                                            <input type="text" class="form-control bg-light" id="firstName" name="txtNome" placeholder="Digite seu nome" required value="<?= $formData['txtNome'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="dataNasc">Data de Nascimento</label>
                                            <input type="date" class="form-control bg-light" id="dataNasc" name="txtDataNasc" required value="<?= $formData['txtDataNasc'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cpf">CPF</label>
                                            <input type="text" class="form-control bg-light" id="cpf" name="txtCpf" placeholder="Digite seu CPF" required value="<?= $formData['txtCpf'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control bg-light" id="email" name="txtEmail" placeholder="Digite seu e-mail" required value="<?= $formData['txtEmail'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="phone">Telefone</label>
                                            <input type="text" class="form-control bg-light" id="phone" name="txtTelefone" placeholder="Digite seu telefone" required value="<?= $formData['txtTelefone'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cep">CEP</label>
                                            <input type="text" class="form-control bg-light" id="cep" name="txtCep" placeholder="Digite seu CEP" required value="<?= $formData['txtCep'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="uf">UF</label>
                                            <input type="text" class="form-control bg-light" id="uf" name="txtUf" placeholder="Digite seu estado (UF)" minlength="2" maxlength="2" required value="<?= $formData['txtUf'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="cidade">Cidade</label>
                                            <input type="text" class="form-control bg-light" id="cidade" name="txtCidade" placeholder="Digite sua cidade" required value="<?= $formData['txtCidade'] ?? '' ?>">
                                        </div>

                                        <div class="col-md-6 form-group mt-2">
                                            <label for="endereco">Endereço</label>
                                            <input type="text" class="form-control bg-light" id="endereco" name="txtEndereco" placeholder="Digite seu endereço" required value="<?= $formData['txtEndereco'] ?? '' ?>">
                                        </div>

                                        <div class="col-12 form-group mt-2 mb-3">
                                            <label for="password">Senha</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control bg-warning-subtle" id="inputConfirmPass" name="txtSenha" placeholder="Insira a senha" required>
                                                <div class="input-group-text">
                                                    <i class="bi-eye-fill" id="icontogleConfirmPass" onclick="viewSenhaCad()" style="cursor: pointer;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button id="cadastro" type="submit" class="btn btn-primary">Cadastrar</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
                                    </div>
                                </form>


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
    <script src="../src/js/cep.js"></script>
</body>

</html>