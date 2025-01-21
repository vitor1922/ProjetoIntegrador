<?php
session_start();

// Simula a lista de comentários que já existe (normalmente vinda do banco de dados)
$comentarios = [
    1 => 'Ótimo produto!',
    2 => 'Não gostei muito da qualidade.',
    3 => 'Excelente atendimento, voltarei mais vezes!',
];

// Verifica se o ID do comentário foi passado via URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Checa se o comentário existe
    if (array_key_exists($id, $comentarios)) {
        $comentarioAtual = $comentarios[$id];
    } else {
        echo "Comentário não encontrado.";
        exit;
    }

    // Quando o formulário for enviado, atualiza o comentário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novoComentario = $_POST['comentario'];

        // Simula a atualização do comentário (aqui você pode atualizar um banco de dados ou arquivo)
        $_SESSION['comentarios'][$id] = $novoComentario;

        echo "Comentário atualizado para: $novoComentario";
    }
} else {
    echo "Comentário não especificado.";
}
?>

<h3>Editar Comentário</h3>
<form method="POST">
    <textarea name="comentario" required><?= $comentarioAtual ?? '' ?></textarea><br><br>
    <button type="submit">Atualizar Comentário</button>
</form>
