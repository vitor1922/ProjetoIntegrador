<?php 
session_start();
include_once("../constantes.php");
include_once('../data/conexao.php');

date_default_timezone_set('America/Sao_Paulo');

$perfil = $_SESSION['perfil'] ?? null;
$logado = $_SESSION['logado'] ?? false;

if (!$logado) {
    header("Location: ../login.php");
    exit;
}

$filterQuery = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filtro'])) {
    $filtro = $_POST['filtro'];
    
    if ($filtro == 'mais_recentes') {
        $filterQuery = "ORDER BY a.id_avaliacao DESC";
    } elseif ($filtro == 'mais_antigos') {
        $filterQuery = "ORDER BY a.id_avaliacao ASC";
    } elseif ($filtro == 'por_turma') {
        $filterQuery = "ORDER BY t.numero_da_turma";
    }
} else {
    $filterQuery = "ORDER BY a.id_avaliacao DESC";
}

// Lista de palavras proibidas (exemplo)
$palavrasProibidas = ['cu', 'palavra2', 'palavra3']; // Substitua pelas palavras que deseja bloquear

// Função para filtrar palavras inapropriadas
function filtrarPalavras($comentario, $palavrasProibidas) {
    foreach ($palavrasProibidas as $palavra) {
        $comentario = str_ireplace($palavra, '***', $comentario); // Substitui palavras por "***"
    }
    return $comentario;
}

try {
    $sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.id_usuario, 
                            u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, 
                            a.id_avaliacao
                    FROM avaliacao a
                    JOIN usuario u ON a.id_usuario = u.id_usuario
                    LEFT JOIN turma t ON a.id_turma = t.id_turma
                    LEFT JOIN post p ON a.id_usuario = p.id_usuario
                    $filterQuery";  
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

    // Filtra o comentário antes de inserir
    $comentarioFiltrado = filtrarPalavras($comentario, $palavrasProibidas);

    try {
        $sqlInserirAvaliacao = "INSERT INTO avaliacao (nivel_de_avaliacao, comentario, id_usuario)
                                VALUES (:nivel_de_avaliacao, :comentario, :id_usuario)";
        $stmt = $conexao->prepare($sqlInserirAvaliacao);
        $stmt->bindParam(':nivel_de_avaliacao', $nivelAvaliacao);
        $stmt->bindParam(':comentario', $comentarioFiltrado); // Usa o comentário filtrado
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        die("Erro ao salvar avaliação: " . $e->getMessage());
    }
}

if (isset($_GET['deletar'])) {
    $idComentario = $_GET['deletar'];

    try {
        $sqlComentario = "SELECT id_usuario FROM avaliacao WHERE id_avaliacao = :id_avaliacao";
        $stmtComentario = $conexao->prepare($sqlComentario);
        $stmtComentario->bindParam(':id_avaliacao', $idComentario);
        $stmtComentario->execute();
        $comentario = $stmtComentario->fetch(PDO::FETCH_ASSOC);

        if ($comentario) {
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
        .stars {
            display: inline-block;
            direction: ltr; /* Estrelas devem ser exibidas da esquerda para a direita */
        }

        .stars input {
            display: none;
        }

        .stars label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
        }

        .stars input:checked ~ label {
            color: #FFD700; /* Estrela preenchida após a seleção */
        }

        .stars input:hover ~ label {
            color: #FFD700; /* Estrelas ficam amarelas ao passar o mouse */
        }

        .stars input:checked + label {
            color: #FFD700; /* Colorir estrelas preenchidas */
        }

        .stars label:hover, .stars input:checked ~ label:hover {
            color: #FFD700;
        }

        .img-avaliacao {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .excluir-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: black;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-auto">
            <a href="areaInstrutor.php" class="btn d-flex align-items-center">
                <i class="bi bi-arrow-left-short azul-senac fw-bold fs-1"></i> 
            </a>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center">Avaliações</h2>

    <form method="POST" class="mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <label for="filtro" class="form-label">Filtrar avaliações:</label>
                <select name="filtro" id="filtro" class="form-select" onchange="this.form.submit()">
                    <option value="mais_recentes" <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'mais_recentes') echo 'selected'; ?>>Mais recentes</option>
                    <option value="mais_antigos" <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'mais_antigos') echo 'selected'; ?>>Mais antigos</option>
                    <option value="por_turma" <?php if (isset($_POST['filtro']) && $_POST['filtro'] == 'por_turma') echo 'selected'; ?>>Por turma</option>
                </select>
            </div>
        </div>
    </form>

    <h3 class="mt-5">Deixe sua avaliação:</h3>
    <form method="POST">
        <div class="mb-3">
            <div class="stars">
                <input type="radio" name="nivel_de_avaliacao" id="star1" value="1" required>
                <label for="star1">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star2" value="2" required>
                <label for="star2">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star3" value="3" required>
                <label for="star3">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star4" value="4" required>
                <label for="star4">★</label>
                <input type="radio" name="nivel_de_avaliacao" id="star5" value="5" required>
                <label for="star5">★</label>
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
                            <a href="./perfilVer.php?id=<?= $avaliacao['id_usuario'] ?>">
                                <img src="../foto/<?= !empty($avaliacao['foto']) && file_exists("../foto/" . $avaliacao['foto']) ? htmlspecialchars($avaliacao['foto']) : 'default-avatar.png' ?>" 
                                    class="img-avaliacao rounded-circle me-3" 
                                    alt="Imagem de perfil">
                            </a>
                            <div>
                                <p class="mb-0 fw-bold"><?= htmlspecialchars($avaliacao['nome']) ?></p>
                                <p class="mb-0 text-muted small">Turma: <?= htmlspecialchars($avaliacao['numero_da_turma']) ?> | Início: <?= htmlspecialchars($avaliacao['data_inicio']) ?> | Fim: <?= htmlspecialchars($avaliacao['data_final']) ?></p>
                            </div>
                        </div>
                        <div class="stars">
                            <?php 
                            // Arredondar para o inteiro mais próximo
                            $nivelAvaliado = round($avaliacao['nivel_de_avaliacao']);
                            for ($i = 1; $i <= 5; $i++): 
                                // Mostrar estrelas preenchidas ou vazias dependendo do valor arredondado
                                $starColor = ($i <= $nivelAvaliado) ? '#FFD700' : '#ccc';
                            ?>
                                <span class="bi bi-star-fill" style="color: <?= $starColor ?>"></span>
                            <?php endfor; ?>
                            <span class="ms-2"><?= number_format($nivelAvaliado, 1) ?></span>
                        </div>
                    </div>
                    <p class="mt-3 text-muted"><?= htmlspecialchars($avaliacao['comentario']) ?></p>

                    <?php if ($_SESSION['id_usuario'] == $avaliacao['id_usuario'] || $_SESSION['perfil'] == 'admin'): ?>
                        <button class="btn excluir-btn" data-bs-toggle="modal" data-bs-target="#modalDeletar" data-id="<?= $avaliacao['id_avaliacao'] ?>">
                            <i class="bi bi-trash"></i>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Não há avaliações disponíveis.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeletar" tabindex="-1" aria-labelledby="modalDeletarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeletarLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir esta avaliação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" class="btn btn-danger" id="confirmDelete">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
    const modalDeletar = document.querySelector('#modalDeletar');
    modalDeletar.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const idAvaliacao = button.getAttribute('data-id');
        const confirmDelete = modalDeletar.querySelector('#confirmDelete');
        confirmDelete.setAttribute('href', `?deletar=${idAvaliacao}`);
    });
</script>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
