<?php

session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;
$idUsuario = $_SESSION['id_usuario'];
#inicia as variaveis de sessão
include_once('../../constantes.php');
require_once('../../data/conexao.php');

try {
    $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";
    $select = $conexao->prepare($sql);
    $select->bindParam(':id_usuario', $idUsuario);
    $select->execute();

    if ($select->rowCount() > 0) {
        $login = $select->fetch(PDO::FETCH_ASSOC);
        $senhaReal = $login['senha'];
        $emailReal =  $login['email'];
        
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_SPECIAL_CHARS);
        $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);
        $novaSenha = filter_input(INPUT_POST, "txtNovaSenha", FILTER_SANITIZE_SPECIAL_CHARS);
        
    
        if ($emailReal === $email && password_verify($senha, $senhaReal)) {
            $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
    
                $sqlAtualiza = "UPDATE usuario SET senha=:senha WHERE id_usuario = :id_usuario";
                $update = $conexao->prepare($sqlAtualiza);
                $update->bindParam(":id_usuario", $idUsuario);
                $update->bindParam(":senha", $senhaCriptografada);
    
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
            $_SESSION['mensagem'] = "O email ou senha estão incorretos.";
            header("Location: " . BASE_URL . "screens/configuracoes.php");
            exit;
        }
    }

} catch (PDOException $e) {
    $_SESSION['mensagem'] = "Erro ao acessar o banco de dados: " . $e->getMessage();
    $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
    header("Location: " . BASE_URL . "screens/configuracoes.php");
    exit;
} finally {
    #fechar o banco de dados
    unset($conexao);
}


