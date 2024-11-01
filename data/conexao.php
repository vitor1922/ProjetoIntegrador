<?php

# Variáveis para acessar o do Banco de Dados
#---------------------------------------------------------------------------------------------------------
$db_host = 'localhost';
$db_nome = 'dbpisalao2024';
$db_user = 'root';
$db_senha = '';

try {
    $conexao = new PDO("mysql:host=$db_host; dbname=$db_nome; charset=utf8", $db_user, $db_senha);
} catch (PDOException $erro) {
    echo 'Erro ao conectar com o Banco de Dados: ' . $erro->getMessage();
}

?>