<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;
#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $DDD = filter_input(INPUT_POST, "txtDDD", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_SPECIAL_CHARS);
    $telefone = $DDD . $telefone;
    $idUsuario = $_SESSION['id_usuario'];

    if (strlen($telefone) == 11) {
        try {
            $sql = "UPDATE usuario SET telefone=:telefone WHERE id_usuario = :id_usuario";
            $update = $conexao->prepare($sql);
            $update->bindParam(":id_usuario", $idUsuario);
            $update->bindParam(":telefone", $telefone);

            if ($update->execute()) {
                $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                $_SESSION['mensagem'] = "Atualizado com sucesso.";
                
                header("Location: " . BASE_URL . "screens/configuracoes.php");
                exit;
            } else {
                throw new Exception("Ocorreu um Erro");
            }
        } catch (Exception $e) {
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            $_SESSION["mensagem"] = "Ocorreu um erro ao Atualizar";
            header("Location: " . BASE_URL . "screens/configuracoes.php");
            exit;
        } finally {
            unset($conexao);
        }
    }else{
        $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
        $_SESSION['mensagem'] = "telefone precisa ter 11 digitos";
    }
};
