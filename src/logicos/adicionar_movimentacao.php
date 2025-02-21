<?php
include_once("../data/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produto = $_POST['id_produto'];
    $qtde = $_POST['qtde'];
    $status = $_POST['status'];

    // Inserir movimentação no estoque
    $query = "INSERT INTO estoque (data_movimentacao, id_produto, qtde, status) VALUES (NOW(), :id_produto, :qtde, :status)";
    $stmt = $conexao->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':qtde', $qtde);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        // Redirecionar de volta para a página anterior após o sucesso
        header("Location: estoqueProfessor.php?success=Movimentação adicionada com sucesso!");
        exit();
    } else {
        echo "Erro ao adicionar movimentação: " . $stmt->errorInfo()[2];
    }
}
?>
