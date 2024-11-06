<?php
session_start();
$_SESSION['mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $DDD = filter_input(INPUT_POST, "txtDDD", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = explode("-", $telefone);
    $telefone = $DDD . $telefone[0] . $telefone[1];
    $idUsuario = $_SESSION['id_usuario'];

    if (strlen($telefone) == 11) {
        try {
            $sql = "UPDATE usuario SET telefone=:telefone WHERE id_usuario = :id_usuario";
            $update = $conexao->prepare($sql);
            $update->bindParam(":id_usuario", $idUsuario);
            $update->bindParam(":telefone", $telefone);

            if ($update->execute()) {
                $_SESSION['mensagem'] = "Atualizado com sucesso.";
                $_SESSION['telefone'] = $telefone;
                header("Location: " . BASE_URL . "screens/configuracoes.php");
                exit;
            } else {
                throw new Exception("Ocorreu um Erro");
            }
        } catch (Exception $e) {
            $_SESSION["mensagem"] = "Ocorreu um erro ao Atualizar";
            header("Location: " . BASE_URL . "screens/configuracoes.php");
            exit;
        } finally {
            unset($conexao);
        }
    }else{
        $_SESSION['mensagem'] = "telefone precisa ter 11 digitos";
    }
};
