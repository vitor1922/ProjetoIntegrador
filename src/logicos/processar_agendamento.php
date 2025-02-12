<?php 
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['id_agenda']) && !empty($_POST['id_usuario']) && !empty($_POST[''])) {
        $hora = filter_input(INPUT_POST, "#", FILTER_SANITIZE_SPECIAL_CHARS);
    }
}
?>