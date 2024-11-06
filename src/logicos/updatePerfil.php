<?php
session_start();
$_SESSION['mensagem'] = NULL;

#inicia as variaveis de sessão
include('../constantes.php');
include_once('../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = filter_input(INPUT_POST, "txtUserId", FILTER_SANITIZE_SPECIAL_CHARS);
    $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "txtBiografia", FILTER_SANITIZE_EMAIL);

    try {
        $sql = "UPDATE usuarios SET nome=:nome , email=:email WHERE usuario_id = :userId";
        $update = $conexao->prepare($sql);
        $update->bindParam(":userId", $userId);
        $update->bindParam(":nome", $nome);
        $update->bindParam(":email", $email);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Atualizado com sucesso.";
            
            header("Location: " . BASE_URL . "screens/perfil.php");
            exit;
        } else {
            throw new Exception("Ocorreu um Erro");
        }
    } catch (Exception $e) {
        $_SESSION["mensagem"] = "Ocorreu um erro ao Atualizar";
        header("Location: " . BASE_URL . "screens/perfil.php");
        exit;
    } finally {
        unset($conexao);
    }
}
