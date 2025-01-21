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

// Adicionar avaliação (apenas para clientes)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'], $_POST['nivel_de_avaliacao']) && $perfil === 'cliente') {
    $comentario = trim($_POST['comentario']);
    $nivel_de_avaliacao = $_POST['nivel_de_avaliacao']; // Nota de 1 a 5
    $id_usuario = $_SESSION['id_usuario']; // ID do usuário logado
    $id_turma = $_POST['id_turma'] ?? null;
    $id_agendamento = $_POST['id_agendamento'] ?? null;
    $id_aluno = $_POST['id_aluno'] ?? null;

    if (!empty($comentario) && in_array($nivel_de_avaliacao, [1, 2, 3, 4, 5])) {
        // Inserir avaliação na tabela
        $sqlAvaliacao = "INSERT INTO avaliacao (nivel_de_avaliacao, comentario, id_usuario, id_turma, id_agendamento, id_aluno) 
                         VALUES (:nivel_de_avaliacao, :comentario, :id_usuario, :id_turma, :id_agendamento, :id_aluno)";
        $stmtAvaliacao = $conexao->prepare($sqlAvaliacao);
        $stmtAvaliacao->bindParam(':nivel_de_avaliacao', $nivel_de_avaliacao);
        $stmtAvaliacao->bindParam(':comentario', $comentario);
        $stmtAvaliacao->bindParam(':id_usuario', $id_usuario);
        $stmtAvaliacao->bindParam(':id_turma', $id_turma);
        $stmtAvaliacao->bindParam(':id_agendamento', $id_agendamento);
        $stmtAvaliacao->bindParam(':id_aluno', $id_aluno);
        $stmtAvaliacao->execute();
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Recuperar as avaliações
$sqlAvaliacoes = "SELECT a.nivel_de_avaliacao, a.comentario, a.data_avaliacao, u.nome, u.foto_perfil
                  FROM avaliacao a
                  JOIN usuarios u ON a.id_usuario = u.id_usuario
                  ORDER BY a.data_avaliacao DESC";
$stmtAvaliacoes = $conexao->prepare($sqlAvaliacoes);
$stmtAvaliacoes->execute();

$avaliacoes = $stmtAvaliacoes->fetchAll(PDO::FETCH_ASSOC);
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            margin-top: auto;
        }
        .stars {
            color: #FFD700;
            font-size: 1.5em;
        }
        .star {
            cursor: pointer;
        }
        .avaliacao-info {
            display: flex;
            align-items: center;
        }
        .avaliacao-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php include_once("./header.php"); ?>

<div class="container mt-5">
    <h2 class="text-center text-warning">Avaliações</h2>
    
    <!-- Formulário para adicionar avaliação (somente clientes) -->
    <?php if ($perfil === 'cliente'): ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="comentario" class="form-label">Deixe sua avaliação:</label>
                <textarea class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Nível de Avaliação:</label>
                <div id="stars" class="stars">
                    <!-- Avaliação por estrelas -->
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>
                <input type="hidden" name="nivel_de_avaliacao" id="nivel_de_avaliacao" required>
            </div>
            <button type="submit" class="btn btn-warning">Enviar</button>
        </form>

        <script>
            // Lógica para selecionar as estrelas
            const stars = document.querySelectorAll('.star');
            const avaliacaoInput = document.getElementById('nivel_de_avaliacao');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    avaliacaoInput.value = value;

                    // Atualiza a cor das estrelas
                    stars.forEach(s => s.style.color = '#ccc');
                    for (let i = 0; i < value; i++) {
                        stars[i].style.color = '#FFD700'; // Cor de estrela dourada
                    }
                });
            });
        </script>
    <?php endif; ?>

    <!-- Exibição de avaliações -->
    <div class="mt-5">
        <?php if (!empty($avaliacoes)): ?>
            <?php foreach ($avaliacoes as $avaliacao): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="avaliacao-info">
                            <img src="../uploads/<?= htmlspecialchars($avaliacao['foto_perfil']) ?>" alt="Foto de perfil">
                            <h5 class="card-title"><?= htmlspecialchars($avaliacao['nome']) ?></h5>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($avaliacao['comentario']) ?></p>
                        <p class="card-text">
                            <small class="text-muted"><?= date('d/m/Y H:i', strtotime($avaliacao['data_avaliacao'])) ?></small>
                        </p>

                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" style="color: <?= $i <= $avaliacao['nivel_de_avaliacao'] ? '#FFD700' : '#ccc' ?>;">&#9733;</span>
                            <?php endfor; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Nenhuma avaliação disponível.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <?php include_once("./footer.php"); ?>
</footer>

<script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
