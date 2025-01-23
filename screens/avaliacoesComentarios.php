<?php 
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

// Define o fuso horário para o Brasil
date_default_timezone_set('America/Sao_Paulo');

// Verifica se o usuário está logado
$perfil = $_SESSION['perfil'] ?? null;
$logado = $_SESSION['logado'] ?? false;

if (!$logado) {
    header("Location: ../login.php");
    exit;
}

// Recuperar avaliações, comentários e turmas
try {
    $sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.id_usuario, 
                             u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, a.id_avaliacao
                      FROM avaliacao a
                      JOIN usuario u ON a.id_usuario = u.id_usuario
                      LEFT JOIN turma t ON u.id_usuario = t.id_usuario
                      ORDER BY a.id_avaliacao DESC";  
    $stmtAvaliacoes = $conexao->prepare($sqlAvaliacoes);
    $stmtAvaliacoes->execute();
    $avaliacoes = $stmtAvaliacoes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao recuperar avaliações: " . $e->getMessage());
}

// Processar a avaliação enviada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['avaliacao'])) {
    $nivelAvaliacao = $_POST['nivel_de_avaliacao'];
    $comentario = $_POST['comentario'];
    $idUsuario = $_SESSION['id_usuario']; // ID do usuário logado

    try {
        $sqlInserirAvaliacao = "INSERT INTO avaliacao (nivel_de_avaliacao, comentario, id_usuario)
                                VALUES (:nivel_de_avaliacao, :comentario, :id_usuario)";
        $stmt = $conexao->prepare($sqlInserirAvaliacao);
        $stmt->bindParam(':nivel_de_avaliacao', $nivelAvaliacao);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->execute();

        // Redireciona para a mesma página para evitar envio duplicado do formulário
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar avaliação: " . $e->getMessage());
    }
}

// Deletar comentário
if (isset($_GET['deletar'])) {
    $idComentario = $_GET['deletar'];

    // Verifica se o usuário logado é o dono do comentário ou administrador
    try {
        $sqlComentario = "SELECT id_usuario FROM avaliacao WHERE id_avaliacao = :id_avaliacao";
        $stmtComentario = $conexao->prepare($sqlComentario);
        $stmtComentario->bindParam(':id_avaliacao', $idComentario);
        $stmtComentario->execute();
        $comentario = $stmtComentario->fetch(PDO::FETCH_ASSOC);

        if ($comentario) {
            // Se for o dono do comentário ou o administrador
            if ($comentario['id_usuario'] == $_SESSION['id_usuario'] || $_SESSION['perfil'] == 'admin') {
                $sqlDeletar = "DELETE FROM avaliacao WHERE id_avaliacao = :id_avaliacao";
                $stmtDeletar = $conexao->prepare($sqlDeletar);
                $stmtDeletar->bindParam(':id_avaliacao', $idComentario);
                $stmtDeletar->execute();
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "<script>alert('Você não tem permissão para excluir este comentário.');</script>";
            }
        }
    } catch (PDOException $e) {
        die("Erro ao verificar comentário: " . $e->getMessage());
    }
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
    <title>Avaliações</title>
    <style>
        .imgPerfil {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            position: relative;
        }
        .stars {
            font-size: 1.5rem;
            color: #FFD700;
        }
        .star {
            font-size: 1.5rem;
        }
        .comentario-info {
            display: flex;
            align-items: center;
        }
        .comentario-info p {
            margin-bottom: 0;
        }
        .turma-info {
            font-size: 0.9rem;
            color: gray;
        }
        .ordenacao {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
        }
        .ordenacao a {
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }
        .ordenacao a:hover {
            text-decoration: underline;
        }
        .ordenacao .btn {
            font-weight: bold;
            font-size: 0.9rem;
            padding: 5px 15px;
            border: 1px solid #007bff;
            color: #007bff;
            background-color: transparent;
            border-radius: 4px;
        }
        .ordenacao .btn:hover {
            background-color: #007bff;
            color: #fff;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f00;
        }
        .btn-danger:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }
        .btn-danger.btn-sm {
            font-size: 0.75rem;
            padding: 3px 8px;
        }
        .modal-dialog {
            max-width: 400px;
        }
        /* Estilo para o ícone da lixeira */
        .delete-icon {
            position: absolute;
            bottom: 10px;  /* Alinha no canto inferior */
            right: 10px;   /* Alinha no canto direito */
            font-size: 1.5rem;
            color: #000;   /* Cor preta */
            cursor: pointer;
        }
    </style>
    <script>
        // Função para abrir o modal de confirmação
        function confirmarExclusao(url) {
            const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            document.getElementById('confirmDelete').onclick = function() {
                window.location.href = url;
            };
            modal.show();
        }
    </script>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-5">
    <h2 class="text-center text-warning">Avaliações</h2>

    <!-- Formulário de avaliação -->
    <div class="mt-4">
        <h4>Deixe sua avaliação:</h4>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nivel_de_avaliacao" class="form-label">Avaliação</label>
                <div id="nivel_de_avaliacao" class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" class="btn-check" name="nivel_de_avaliacao" id="star<?= $i ?>" value="<?= $i ?>" required>
                        <label class="btn btn-outline-warning" for="star<?= $i ?>">&#9733;</label>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="comentario" class="form-label">Comentário</label>
                <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="avaliacao">Enviar Avaliação</button>
        </form>
    </div>

    <!-- Exibição de avaliações -->
    <div class="mt-4">
        <?php if (!empty($avaliacoes)): ?>
            <?php foreach ($avaliacoes as $avaliacao): ?>
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <a href="./perfilVer.php?id=<?= $avaliacao['id_usuario'] ?>">
                            <?php if (!empty($avaliacao['foto']) && file_exists("../foto/" . $avaliacao['foto'])): ?>
                                <img src="../foto/<?= htmlspecialchars($avaliacao['foto']) ?>" class="imgPerfil me-3" alt="Imagem de perfil">
                            <?php else: ?>
                                <img src="../assets/img/default-avatar.png" class="imgPerfil me-3" alt="Imagem de perfil padrão">
                            <?php endif; ?> </a>
                            <div>
                                <p class="mb-0 fw-bold"><?= htmlspecialchars($avaliacao['nome']) ?></p>
                                <p class="mb-0 turma-info">Turma: <?= htmlspecialchars($avaliacao['numero_da_turma']) ?> | Início: <?= htmlspecialchars($avaliacao['data_inicio']) ?> | Fim: <?= htmlspecialchars($avaliacao['data_final']) ?></p>
                            </div>
                        </div>
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" style="color: <?= $i <= $avaliacao['nivel_de_avaliacao'] ? '#FFD700' : '#ccc' ?>;">&#9733;</span>
                            <?php endfor; ?>
                            <span class="ms-2"><?= number_format($avaliacao['nivel_de_avaliacao'], 1) ?></span>
                        </div>
                    </div>
                    <p class="mt-3 text-muted"><?= htmlspecialchars($avaliacao['comentario']) ?></p>

                    <?php if ($_SESSION['id_usuario'] == $avaliacao['id_usuario'] || $_SESSION['perfil'] == 'admin'): ?>
                        <i class="bi bi-trash delete-icon" onclick="confirmarExclusao('?deletar=<?= $avaliacao['id_avaliacao'] ?>')"></i>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Nenhuma avaliação disponível.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir este comentário? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="confirmDelete" class="btn btn-danger">Excluir</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <?php include_once("./footer.php"); ?>
</footer>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
