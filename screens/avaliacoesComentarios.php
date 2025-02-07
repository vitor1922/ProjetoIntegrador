<?php 
session_start();
include_once("../constantes.php");
include_once("../data/conexao.php");

date_default_timezone_set('America/Sao_Paulo');

$perfil = $_SESSION['perfil'] ?? null;
$logado = $_SESSION['logado'] ?? false;
$idUsuarioLogado = $_SESSION['id_usuario'] ?? null;

if (!$logado) {
    header("Location: ../login.php");
    exit;
}

function filtrarPalavras($comentario, $palavrasProibidas) {
    foreach ($palavrasProibidas as $palavra) {
        $comentario = str_ireplace($palavra, '***', $comentario);
    }
    return $comentario;
}

// Processando o filtro de ordenação
$filtro = $_POST['filtro'] ?? 'mais_recente';

try {
    // Modificando a consulta SQL com base no filtro selecionado
    switch ($filtro) {
        case 'por_turma':
            $sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.id_usuario, 
                                    u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, 
                                    a.id_avaliacao
                            FROM avaliacao a
                            JOIN usuario u ON a.id_usuario = u.id_usuario
                            LEFT JOIN turma t ON a.id_turma = t.id_turma
                            LEFT JOIN post p ON a.id_usuario = p.id_usuario
                            ORDER BY t.numero_da_turma";
            break;
        case 'mais_antigo':
            $sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.id_usuario, 
                                    u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, 
                                    a.id_avaliacao
                            FROM avaliacao a
                            JOIN usuario u ON a.id_usuario = u.id_usuario
                            LEFT JOIN turma t ON a.id_turma = t.id_turma
                            LEFT JOIN post p ON a.id_usuario = p.id_usuario
                            ORDER BY a.id_avaliacao ASC";
            break;
        case 'mais_recente':
        default:
            $sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.id_usuario, 
                                    u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, 
                                    a.id_avaliacao
                            FROM avaliacao a
                            JOIN usuario u ON a.id_usuario = u.id_usuario
                            LEFT JOIN turma t ON a.id_turma = t.id_turma
                            LEFT JOIN post p ON a.id_usuario = p.id_usuario
                            ORDER BY a.id_avaliacao DESC";
            break;
    }

    $stmtAvaliacoes = $conexao->prepare($sqlAvaliacoes);
    $stmtAvaliacoes->execute();
    $avaliacoes = $stmtAvaliacoes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao recuperar avaliações: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['avaliacao'])) {
    $nivelAvaliacao = $_POST['nivel_de_avaliacao'];
    $comentario = $_POST['comentario'];
    $idUsuario = $_SESSION['id_usuario'];

    $comentarioFiltrado = filtrarPalavras($comentario, $palavrasProibidas);

    try {
        $sqlInserirAvaliacao = "INSERT INTO avaliacao (nivel_de_avaliacao, comentario, id_usuario)
                                VALUES (:nivel_de_avaliacao, :comentario, :id_usuario)";
        $stmt = $conexao->prepare($sqlInserirAvaliacao);
        $stmt->bindParam(':nivel_de_avaliacao', $nivelAvaliacao);
        $stmt->bindParam(':comentario', $comentarioFiltrado);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar avaliação: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])) {
    $idAvaliacao = $_POST['id_avaliacao'];
    $idUsuarioComentario = $_POST['id_usuario_comentario'];

    // Verifica se o usuário logado é o autor do comentário ou um administrador/professor
    if ($idUsuarioLogado === $idUsuarioComentario || $perfil === 'admin' || $perfil === 'professor') {
        try {
            $sqlExcluir = "DELETE FROM avaliacao WHERE id_avaliacao = :id_avaliacao";
            $stmt = $conexao->prepare($sqlExcluir);
            $stmt->bindParam(':id_avaliacao', $idAvaliacao);
            $stmt->execute();
            
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } catch (PDOException $e) {
            die("Erro ao excluir avaliação: " . $e->getMessage());
        }
    } else {
        echo "<script>alert('Você não tem permissão para excluir este comentário.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $idAvaliacao = $_POST['id_avaliacao'];
    $novoComentario = $_POST['comentario'];
    
    try {
        $sqlEditar = "UPDATE avaliacao SET comentario = :comentario WHERE id_avaliacao = :id_avaliacao";
        $stmt = $conexao->prepare($sqlEditar);
        $stmt->bindParam(':comentario', $novoComentario);
        $stmt->bindParam(':id_avaliacao', $idAvaliacao);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        die("Erro ao editar avaliação: " . $e->getMessage());
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
        .stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .stars label:hover,
        .stars label:hover ~ label,
        .stars input:checked ~ label {
            color: #FFD700; 
        }

        .dropdown {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .dropdown-menu {
            min-width: 150px;
        }

        .delete-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-5">
    <h2 class="text-center">Avaliações</h2>

    <form method="POST" class="mb-4">
        <div class="form-group">
            <label for="filtro">Filtrar Avaliações:</label>
            <select name="filtro" id="filtro" class="form-control" onchange="this.form.submit()">
                <option value="mais_recente" <?= $filtro == 'mais_recente' ? 'selected' : '' ?>>Mais Recente</option>
                <option value="mais_antigo" <?= $filtro == 'mais_antigo' ? 'selected' : '' ?>>Mais Antigo</option>
                <option value="por_turma" <?= $filtro == 'por_turma' ? 'selected' : '' ?>>Por Turma</option>
            </select>
        </div>
    </form>

    <h3 class="mt-5">Deixe sua avaliação:</h3>
    <form method="POST">
        <div class="mb-3">
            <div class="stars">
                <input type="radio" name="nivel_de_avaliacao" id="star5" value="5" required>
                <label for="star5">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star4" value="4">
                <label for="star4">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star3" value="3">
                <label for="star3">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star2" value="2">
                <label for="star2">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star1" value="1">
                <label for="star1">★</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentário</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3" required></textarea>
        </div>
        <button type="submit" name="avaliacao" class="btn btn-primary">Enviar Avaliação</button>
    </form>

    <div class="mt-4">
        <?php if (!empty($avaliacoes)): ?>
            <?php foreach ($avaliacoes as $avaliacao): ?>
                <div class="card mb-3 p-3 shadow-sm position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="../foto/<?= !empty($avaliacao['foto']) ? htmlspecialchars($avaliacao['foto']) : 'default-avatar.png' ?>" 
                                 class="rounded-circle me-3" width="50" height="50" alt="Imagem de perfil">
                            <div>
                                <p class="mb-0 fw-bold"><?= htmlspecialchars($avaliacao['nome']) ?></p>
                                <p class="mb-0 text-muted small">Turma: <?= htmlspecialchars($avaliacao['numero_da_turma']) ?></p>
                            </div>
                        </div>
                        <div>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="bi bi-star-fill" style="color: <?= $i <= $avaliacao['nivel_de_avaliacao'] ? '#FFD700' : '#ccc' ?>;"></span>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <p class="mt-3"><?= htmlspecialchars($avaliacao['comentario']) ?></p>
                    <!-- Menu de 3 pontos no canto inferior -->
                    <div class="dropdown">
                        <button class="btn p-0 border-0 text-black" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <!-- Editar -->
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $avaliacao['id_avaliacao'] ?>" data-comentario="<?= htmlspecialchars($avaliacao['comentario']) ?>">Editar</a></li>
                            <!-- Excluir -->
                            <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $avaliacao['id_avaliacao'] ?>">Excluir</a></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Não há avaliações disponíveis.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Avaliação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="id_avaliacao" id="editIdAvaliacao">
                    <div class="mb-3">
                        <textarea class="form-control" id="editComentario" name="comentario" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="editar" class="btn btn-primary">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta avaliação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" id="deleteForm" style="display:inline;">
                    <input type="hidden" name="id_avaliacao" id="deleteId">
                    <input type="hidden" name="id_usuario_comentario" value="<?= $idUsuarioLogado ?>">
                    <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
    <?php include_once("./footer.php") ?>
</footer>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Editar avaliação
    var editButtons = document.querySelectorAll('.dropdown-item[data-bs-target="#editModal"]');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var idAvaliacao = this.getAttribute('data-id');
            var comentario = this.getAttribute('data-comentario');

            document.getElementById('editIdAvaliacao').value = idAvaliacao;
            document.getElementById('editComentario').value = comentario;
        });
    });

    // Excluir avaliação
    var deleteButtons = document.querySelectorAll('.dropdown-item[data-bs-target="#confirmDeleteModal"]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var idAvaliacao = this.getAttribute('data-id');
            document.getElementById('deleteId').value = idAvaliacao;
        });
    });
</script>

</body>
</html>
