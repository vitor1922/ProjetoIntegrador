<?php

session_start();
$_SESSION['mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novoEmail = filter_input(INPUT_POST, "txtEmail", FILTER_SANITIZE_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_SPECIAL_CHARS);
    $idUsuario = $_SESSION['id_usuario'];

    if (password_verify($senha, $login["senha"])) {
        echo("<pre>");
        var_dump($login);
        var_dump($login);
        var_dump($login);
        die;
    }
}
