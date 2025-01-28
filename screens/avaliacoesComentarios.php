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
                             u.nome, u.foto, t.numero_da_turma, t.data_inicio, t.data_final, 
                             a.id_avaliacao
                      FROM avaliacao a
                      JOIN usuario u ON a.id_usuario = u.id_usuario
                      LEFT JOIN turma t ON a.id_turma = t.id_turma
                      LEFT JOIN post p ON a.id_usuario = p.id_usuario
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
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .imgPerfil {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            margin-bottom: 20px;
            padding: 20px;
            position: relative;
            box-shadow: none; /* Remove a sombra e as bordas extras do card */
        }

        .stars {
            font-size: 1.5rem;
            color: #FFD700;
        }

        .star {
            font-size: 2rem;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star:hover {
            color: #FFD700;
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
            color: #6c757d;
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

        .delete-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 1.5rem;
            color: #ff5733;
            cursor: pointer;
        }

        .delete-icon:hover {
            color: #c0392b;
        }

        h2, h4 {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .card:hover {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-5">
    <h2 class="text-center text-warning">Avaliações</h2>

    <!-- Formulário de avaliação -->
    <div class="mt-4">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="nivel_de_avaliacao" class="form-label">Avaliação</label>
                <div id="nivel_de_avaliacao" class="d-flex">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" class="btn-check" name="nivel_de_avaliacao" id="star<?= $i ?>" value="<?= $i ?>" required>
                        <label class="btn btn-outline-warning star" for="star<?= $i ?>" data-star="<?= $i ?>">&#9733;</label>
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
                Você tem certeza de que deseja excluir esta avaliação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Excluir</button>
            </div>
        </div>
    </div>
</div>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
    // Função de confirmação para exclusão
    function confirmarExclusao(url) {
        document.getElementById('confirmDelete').onclick = function() {
            window.location.href = url;
        };

        // Abre o modal de confirmação
        var myModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        myModal.show();
    }

    // Função para alterar a cor das estrelas ao passar o mouse
    document.querySelectorAll('.star').forEach(function(star) {
        star.addEventListener('mouseover', function() {
            let rating = this.getAttribute('data-star');
            highlightStars(rating);
        });
        star.addEventListener('mouseout', function() {
            let checkedRating = document.querySelector('input[name="nivel_de_avaliacao"]:checked');
            let rating = checkedRating ? checkedRating.value : 0;
            highlightStars(rating);
        });
    });

    // Função para destacar as estrelas
    function highlightStars(rating) {
        document.querySelectorAll('.star').forEach(function(star) {
            let starValue = star.getAttribute('data-star');
            star.style.color = starValue <= rating ? '#FFD700' : '#ccc';
        });
    }

    // Inicia com o valor da avaliação já setado
    window.onload = function() {
        let checkedRating = document.querySelector('input[name="nivel_de_avaliacao"]:checked');
        let rating = checkedRating ? checkedRating.value : 0;
        highlightStars(rating);
    };
</script>

</body>
</html>
