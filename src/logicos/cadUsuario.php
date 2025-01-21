<?php
session_start();
include('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['txtGenero']) && !empty($_POST['txtNome']) && !empty($_POST['txtDataNasc']) && !empty($_POST['txtCpf']) && !empty($_POST['txtEmail']) && !empty($_POST['txtTelefone']) && !empty($_POST['txtCep']) && !empty($_POST['txtUf']) && !empty($_POST['txtCidade']) && !empty($_POST['txtEndereco']) && !empty($_POST['txtSenha'])) {

        $genero = filter_input(INPUT_POST, "txtGenero", FILTER_SANITIZE_SPECIAL_CHARS);
        $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
        $dataNasc = filter_input(INPUT_POST, "txtDataNasc", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "txtCpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
        $telefone = filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_SPECIAL_CHARS);
        $cep = filter_input(INPUT_POST, "txtCep", FILTER_SANITIZE_SPECIAL_CHARS);
        $uf = filter_input(INPUT_POST, "txtUf", FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_input(INPUT_POST, "txtCidade", FILTER_SANITIZE_SPECIAL_CHARS);
        $endereco = filter_input(INPUT_POST, "txtEndereco", FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);
        
        #senha Cripitografada para ser armazenada no banco de dados 
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $perfil = "cliente";

        # Retirada das Mascaras
        $cep_sem_traco = str_replace("-", "", $cep);
        $cpfSemMascara = preg_replace('/\D/', '', $cpf); 
        $telefoneSemMascara = preg_replace('/\D/', '', $telefone); 



        try {
            $sql = "INSERT INTO usuario (genero, nome, data_de_nascimento, cpf, email, telefone, cep, uf, cidade, endereco, senha, perfil) VALUES ( :genero, :nome, :data_de_nascimento, :cpf, :email, :telefone, :cep, :uf, :cidade, :endereco, :senha, :perfil)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(':genero', $genero);
            $insert->bindParam(':nome', $nome);
            $insert->bindParam(':data_de_nascimento', $dataNasc);
            $insert->bindParam(':cpf', $cpfSemMascara);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':telefone', $telefoneSemMascara);
            $insert->bindParam(':cep', $cep_sem_traco);
            $insert->bindParam(':uf', $uf);
            $insert->bindParam(':cidade', $cidade);
            $insert->bindParam(':endereco', $endereco);
            $insert->bindParam(':senha', $senhaCriptografada);
            $insert->bindParam(':perfil', $perfil);

            if ($insert->execute() && $insert->rowCount() > 0) {
                $_SESSION['mensagem'] = "Cadastrado com sucesso!";
                header("Location: " . BASE_URL . "screens/signUp.php");
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao cadastrar!");
            }
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao cadastrar! / Usuário já cadastrado!";
            header("Location: " . BASE_URL . "screens/signUp.php");
            exit;
        } finally {
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos!";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }
}
