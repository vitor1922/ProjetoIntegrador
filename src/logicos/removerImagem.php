<?php
include_once('../../data/conexao.php');
include('../../constantes.php');
session_start();

$id_usuario = $_SESSION['id_usuario'] ?? null;
$tipo = $_POST['tipo'] ?? null;

if (!$id_usuario || !$tipo) {
    echo "erro";
    exit;
}

$campo = ($tipo === 'banner') ? 'banner' : 'foto';

$sql = "UPDATE usuario SET $campo = NULL WHERE id_usuario = :id_usuario";
$update = $conexao->prepare($sql);
$update->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

if ($update->execute()) {
    echo "sucesso";
} else {
    echo "erro";
}
?>
