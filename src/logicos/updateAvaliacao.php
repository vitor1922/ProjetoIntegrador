<!-- src/updateavaliacao.php -->
<?php
session_start();
include_once("../data/conexao.php");  // Conexão com o banco de dados
include("../constantes.php"); // Definir BASE_URL e outras constantes

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    header("Location: " . BASE_URL . "screens/perfil.php.php");
    exit;
}

// Recebe os dados do formulário
$comentario = $_POST['comentario'] ?? '';
$nivel_de_avaliacao = $_POST['nivel_de_avaliacao'] ?? 0;
$nome = $_SESSION['nome'];  // Pega o nome do usuário logado

// Validação dos dados (se necessário)
if (empty($comentario) || empty($nivel_de_avaliacao)) {
    header("Location: " . BASE_URL . "screens/avaliacoesComentarios.php?status=erro");
    exit;
}

// Insere a avaliação no banco de dados
$sql = "INSERT INTO avaliacoes (nome, comentario, nivel_de_avaliacao, data) VALUES (:nome, :comentario, :nivel_de_avaliacao, NOW())";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':comentario', $comentario);
$stmt->bindParam(':nivel_de_avaliacao', $nivel_de_avaliacao);

// Executa a consulta
if ($stmt->execute()) {
    // Redireciona de volta para a página de avaliações com sucesso
    header("Location: " . BASE_URL . "screens/avaliacoesComentarios.php?status=success");
    exit;
} else {
    // Caso haja erro
    header("Location: " . BASE_URL . "screens/avaliacoesComentarios.php?status=error");
    exit;
}
?>
