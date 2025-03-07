
<?php
include('../constantes.php');
include_once("../data/conexao.php");

session_start();

// Verificar se o usuário está logado (se necessário)

// Buscar todos os logs do banco de dados
$sql = "SELECT l.id, l.tipo, l.mensagem, l.data_criacao, u.nome AS nomeUser
        FROM logs l
        INNER JOIN usuario u ON l.id_usuario = u.id 
        ORDER BY l.data_criacao DESC";  // Ordernar os logs pela data de criação

$stmt = $conexao->prepare($sql);
$stmt->execute();

// Armazenar os resultados em um array
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Logs de Alterações</title>
</head>

<body>
    <div class="container">
        <h1>Logs de Alterações</h1>

        <!-- Exibir os logs -->
        <?php if ($logs): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Tipo</th>
                        <th>Mensagem</th>
                        <th>IP</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= htmlspecialchars($log['id']) ?></td>
                            <td><?= htmlspecialchars($log['usuario_nome']) ?></td>
                            <td><?= htmlspecialchars($log['tipo']) ?></td>
                            <td><?= htmlspecialchars($log['mensagem']) ?></td>
                            <td><?= htmlspecialchars($log['ip']) ?></td>
                            <td><?= htmlspecialchars($log['data_criacao']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum log encontrado.</p>
        <?php endif; ?>
    </div>
</body>

</html>
