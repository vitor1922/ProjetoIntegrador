<?php
session_start();
include('../../constantes.php');
include_once('../../data/conexao.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $camposObrigatorios = [$_POST];

    
  
    // Verificação de campos vazios
    foreach ($camposObrigatorios[0] as $campo) {
        if (empty($campo)) {
            $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
            header("Location: " . BASE_URL . "/index.php");
            exit;
        }
    }

    // Sanitização dos dados
    $dados = array_map(function ($campo) {
        return filter_input(INPUT_POST, $campo, FILTER_SANITIZE_SPECIAL_CHARS);
    }, $_POST);

    var_dump($dados);
    die;

    $dados['txtEmail'] = filter_var($dados['txtEmail'], FILTER_SANITIZE_EMAIL);
    $dados['txtSenha'] = password_hash($dados['txtSenha'], PASSWORD_DEFAULT);
    $dados['perfil'] = "cliente";

    // Remoção de máscaras
    $cep_sem_traco = str_replace("-", "", $dados['txtCep']);
    $cpfSemMascara = preg_replace('/\D/', '', $dados['txtCpf']);
    $telefoneSemMascara = preg_replace('/\D/', '', $dados['txtTelefone']);

    

    if (strlen($cpfSemMascara) < 11) {
        $_SESSION['mensagem'] = "CPF inválido! Por favor, insira um CPF com 11 dígitos.";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }
    
    if (strlen($telefoneSemMascara) < 10 || strlen($dados['txtTelefone']) > 11) {
        $_SESSION['mensagem'] = "Telefone inválido! O número deve conter 10 ou 11 dígitos (DDD + número).";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }

    try {
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

        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar!";
        }

        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = "Erro: " . $e->getMessage();
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    } finally {
        unset($conexao);
    }
}

