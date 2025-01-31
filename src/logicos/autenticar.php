<?php
session_start();
$_SESSION['mensagem'] = null;
$_SESSION['logado'] = FALSE;

# Estabelece a conexão com BD
require_once('../../data/conexao.php');
include("../../constantes.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['txtEmail']) && !empty($_POST['txtSenha'])) {
        try {
            $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_EMAIL);
            $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);

            // Consulta para verificar se o usuário existe
            $sql = "SELECT * FROM usuario WHERE email = :email";
            $select = $conexao->prepare($sql);
            $select->bindParam(':email', $email);
            $select->execute();

            if ($select->rowCount() > 0) {
                $login = $select->fetch(PDO::FETCH_ASSOC);
                

                // Verifica se a senha é correta
                if ($login['email'] === $email && password_verify($senha, $login["senha"])) { #password_verify($senha, $login["senha"])
                    $_SESSION['logado'] = TRUE;
                    $_SESSION['id_usuario'] = $login['id_usuario'];
                    $_SESSION['nome'] = $login['nome'];
                    $_SESSION['perfil'] = $login['perfil'];
                    

                    if ($login['perfil'] === 'admin' || $login['perfil'] === 'professor') {
                        header("Location: " . BASE_URL . "screens/areaInstrutor.php");
                        exit;
                    } elseif ($login['perfil'] === 'aluno' || $login['perfil'] === 'cliente') {
                        header("Location: " . BASE_URL . "index.php");
                        exit;
                    }
                }
            }

            // Se chegar aqui, o email ou a senha são inválidos
            $_SESSION['mensagem'] = "Usuário ou Senha Inválido!";
            header("Location: " . BASE_URL . "screens/signUp.php");
            exit;
        } catch (PDOException $e) {
            $_SESSION['mensagem'] = "Erro ao acessar o banco de dados: " . $e->getMessage();
            header("Location: " . BASE_URL . "screens/signUp.php");
            exit;
        } finally {
            #fechar o banco de dados
            unset($conexao);
        }
    } else {
        $_SESSION['mensagem'] = "Obrigatório preencher todos os campos!";
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }
}
