<?php

session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;
include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novoEmail = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);
    $idUsuario = $_SESSION['id_usuario'];


    try {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
        $select = $conexao->prepare($sql);
        $select->bindParam(':id_usuario', $idUsuario);
        $select->execute();

        if ($select->rowCount() > 0) {
            $login = $select->fetch(PDO::FETCH_ASSOC);
            $senhaReal = $login['senha'];
            
        }

        if (password_verify($senha, $senhaReal)) {

            $sqlAtualiza = "UPDATE usuario SET email=:email WHERE id_usuario = :id_usuario";
            $update = $conexao->prepare($sqlAtualiza);
            $update->bindParam(":id_usuario", $idUsuario);
            $update->bindParam(":email", $novoEmail);

            if ($update->execute()) {
                $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                $_SESSION['mensagem'] = "Atualizado com sucesso.";
                header("Location: " . BASE_URL . "screens/configuracoes.php");
                exit;
            } else {
                throw new Exception("Ocorreu um Erro");
            }
        } else {
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            $_SESSION['mensagem'] = "A senha está incorreta.";
            header("Location: " . BASE_URL . "screens/configuracoes.php");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
        $_SESSION["mensagem"] = "Ocorreu um erro ao Atualizar";
        header("Location: " . BASE_URL . "screens/configuracoes.php");
        exit;
    } finally {
        unset($conexao);
    }
}
