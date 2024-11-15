<?php
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

// Habilitar relatórios de erro para depuração
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Verificação de sessão
$perfil = $_SESSION['perfil'] ?? null; // Pode ser 'cliente' ou 'instrutor'
$logado = $_SESSION['logado'] ?? false;
$usuarioId = $_SESSION['usuario_id'] ?? null;

// Redireciona para a página de login se o usuário não estiver logado
if (!$logado) {
    header("Location: ../login.php");
    exit;
}

// Adicionando um novo comentário (apenas para clientes)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario']) && $perfil === 'cliente') {
    $comentario = trim($_POST['comentario']);

    if (!empty($comentario)) {
        // Inserir comentário na tabela
        $stmt = $conexao->prepare("INSERT INTO comentarios (usuario_id, comentario) VALUES (?, ?)");
        
        if ($stmt) {
            $stmt->bind_param('is', $usuarioId, $comentario);
            $stmt->execute();
            $stmt->close();
        } else {
            die("Erro ao preparar a consulta de inserção: " . $conexao->error);
        }
    }

    // Redirecionar após o envio do comentário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Deletando um comentário (apenas para instrutores)
if (isset($_GET['delete']) && $perfil === 'instrutor') {
    $comentarioId = $_GET['delete'];

    // Preparar e executar a deleção
    $stmt = $conexao->prepare("DELETE FROM comentarios WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param('i', $comentarioId);
        $stmt->execute();
        $stmt->close();
    } else {
        die("Erro ao preparar a consulta de deleção: " . $conexao->error);
    }

    // Redirecionar após a deleção
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Listar todos os comentários
$stmt = $conexao->prepare("SELECT c.id, c.comentario, c.data_comentario, u.nome 
                        FROM comentarios c 
                        JOIN usuarios u ON c.usuario_id = u.id 
                        ORDER BY c.data_comentario DESC");

if ($stmt) {
    $stmt->execute();
    $result = $stmt->get_result();
    $comentarios = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    die("Erro ao preparar a consulta de seleção: " . $conexao->);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Comentários</title>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-5">
    <h2 class="text-center text-warning">Comentários</h2>
    
    <?php if ($perfil === 'cliente'): ?>
    <!-- Formulário para adicionar um novo comentário -->
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="comentario" class="form-label">Deixe seu comentário:</label>
            <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Enviar</button>
    </form>
    <?php endif; ?>

    <!-- Listagem de comentários -->
    <div class="mt-5">
        <?php if (!empty($comentarios)): ?>
            <?php foreach ($comentarios as $comentario): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($comentario['nome']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($comentario['comentario']) ?></p>
                        <p class="card-text">
                            <small class="text-muted"><?= date('d/m/Y H:i', strtotime($comentario['data_comentario'])) ?></small>
                        </p>
                        
                        <?php if ($perfil === 'instrutor'): ?>
                            <!-- Botão para deletar comentário (somente para instrutores) -->
                            <a href="?delete=<?= $comentario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente deletar este comentário?')">
                                <i class="bi bi-trash"></i> Deletar
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Nenhum comentário disponível.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once("./footer.php"); ?>
<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
