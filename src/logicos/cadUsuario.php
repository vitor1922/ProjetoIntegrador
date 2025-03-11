<?php
session_start();
include('../../constantes.php');
include_once('../../data/conexao.php');
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION['formulario'] = $_POST;
    $camposObrigatorios = $_POST;

    // Verificação de campos vazios
    foreach ($camposObrigatorios as $campo) {
        if (empty($campo)) {
            $_SESSION['mensagem'] = "O campo " . ucfirst(str_replace('txt', '', $campo)) . " é obrigatório!";
            header("Location: " . BASE_URL . "/index.php");
            exit;
        }
    }

    // Função para verificar a força da senha
    function verificarForcaSenha($senha){
        if (strlen($senha) < 8) return "A senha deve ter pelo menos 8 caracteres.";
        if (!preg_match('/[A-Z]/', $senha)) return "A senha deve conter pelo menos uma letra maiúscula.";
        if (!preg_match('/[a-z]/', $senha)) return "A senha deve conter pelo menos uma letra minúscula.";
        if (!preg_match('/\d/', $senha)) return "A senha deve conter pelo menos um número.";
        if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $senha)) return "A senha deve conter pelo menos um caractere especial (!@#$%^&*).";
        return true;
    }

    // Verifica se a senha é forte antes de continuar
    $validacaoSenha = verificarForcaSenha($_POST['txtSenha']);
    if ($validacaoSenha !== true) {
        $_SESSION['mensagem'] = "Senha fraca: " . $validacaoSenha;
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }

    // Sanitização dos dados (após verificação de campos vazios)
    $dados = array_map(function ($valorCampo) {
        return htmlspecialchars($valorCampo, ENT_QUOTES, 'UTF-8');
    }, $_POST);
    // Sanitização específica
    $dados['txtEmail'] = filter_var($dados['txtEmail'], FILTER_SANITIZE_EMAIL);
    $dados['txtSenha'] = password_hash($dados['txtSenha'], PASSWORD_DEFAULT);
    $dados['perfil'] = "cliente";
    // Remoção de máscaras
    $cep_sem_traco = str_replace("-", "", $dados['txtCep']);
    $cpfSemMascara = preg_replace('/\D/', '', $dados['txtCpf']);
    $telefoneSemMascara = preg_replace('/\D/', '', $dados['txtTelefone']);
    // Validações de CPF e Telefone
    if (strlen($cpfSemMascara) < 11) {
        $_SESSION['mensagem'] = "CPF inválido! O CPF deve conter exatamente 11 dígitos.";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }
    if (strlen($telefoneSemMascara) < 11) {
        $_SESSION['mensagem'] = "Telefone inválido! O número deve conter 11 dígitos (DDD + número).";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }
    // Inserção no banco
    try {
        // Verificar se CPF ou E-mail já estão cadastrados
        $sqlVerifica = "SELECT id_usuario FROM usuario WHERE cpf = :cpf OR email = :email";
        $stmtVerifica = $conexao->prepare($sqlVerifica);
        $stmtVerifica->execute([
            ':cpf' => $cpfSemMascara,
            ':email' => $dados['txtEmail']
        ]);
        if ($stmtVerifica->rowCount() > 0) {
            $_SESSION['mensagem'] = "CPF ou E-mail já cadastrado!";
            header("Location: " . BASE_URL . "screens/signUp.php");
            exit;
        }
        $sql = "INSERT INTO usuario (genero, nome, data_de_nascimento, cpf, email, telefone, cep, uf, cidade, endereco, senha, perfil) 
                VALUES (:genero, :nome, :dataNasc, :cpf, :email, :telefone, :cep, :uf, :cidade, :endereco, :senha, :perfil)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ':genero' => $dados['txtGenero'],
            ':nome' => $dados['txtNome'],
            ':dataNasc' => $dados['txtDataNasc'],
            ':cpf' => $cpfSemMascara,
            ':email' => $dados['txtEmail'],
            ':telefone' => $telefoneSemMascara,
            ':cep' => $cep_sem_traco,
            ':uf' => $dados['txtUf'],
            ':cidade' => $dados['txtCidade'],
            ':endereco' => $dados['txtEndereco'],
            ':senha' => $dados['txtSenha'],
            ':perfil' => $dados['perfil']
        ]);
        $_SESSION['mensagem'] = $stmt->rowCount() > 0 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!";
        $_SESSION['email_cadastrado'] = $dados['txtEmail'];
        unset($_SESSION['formulario']);
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro ao processar seu cadastro. Tente novamente mais tarde.";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    } finally {
        unset($conexao);
    }
}
