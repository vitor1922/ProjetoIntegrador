<?php
include_once("../constantes.php");
include_once('../data/conexao.php');

session_start();
$perfil = $_SESSION['perfil'] ?? "cliente";
$logado = $_SESSION['logado'] ?? NULL;
$mensagem = $_SESSION['mensagem'] ?? NULL;
$perfil_mensagem = $_SESSION['perfil_mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nome = $_SESSION['nome'] ?? "";
$id_usuario = $_SESSION['id_usuario'] ?? "";

// Verificar se o usuário está logado
if (!$_SESSION['logado']) {
    header("Location: " . BASE_URL . "screens/signUp.php");
    exit;
}

// Incrementar ou decrementar quantidade no estoque via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $id_produto = intval($_POST['id_produto']);
    $acao = $_POST['acao']; // "incrementar" ou "decrementar"

    $alteracao = ($acao === 'incrementar') ? 1 : -1;

    try {
        $sql_update = "UPDATE estoque SET qtde = qtde + :alteracao WHERE id_produto = :id_produto";
        $stmt_update = $conexao->prepare($sql_update);
        $stmt_update->bindValue(':alteracao', $alteracao, PDO::PARAM_INT);
        $stmt_update->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_update->execute();

        // Retornar a quantidade atualizada
        $sql_select = "SELECT qtde FROM estoque WHERE id_produto = :id_produto";
        $stmt_select = $conexao->prepare($sql_select);
        $stmt_select->bindValue(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_select->execute();
        $result = $stmt_select->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'qtde' => $result['qtde']]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

// Consulta para trazer os produtos com base no estoque
$sql = "
    SELECT p.id_produto, p.nome, p.descricao, p.unidade, p.qtde_min, p.qtde_max, 
        e.qtde, e.data_movimentacao 
    FROM produto p
    INNER JOIN estoque e ON p.id_produto = e.id_produto
";

$select = $conexao->prepare($sql);

if ($select->execute()) {
    $produtos = $select->fetchAll(PDO::FETCH_ASSOC);
} else {
    $produtos = [];
}

// Fechar conexão com o banco
unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <meta name="author" content="Victor">
    <link href="../src/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include_once("./header.php"); ?>

    <div class="container">
        <hr class="w-100 my-0 border-2 border-dark">
        <div class="m-3">
            <i class="bi bi-arrow-left fs-3"></i>
        </div>
        <div class="titulo d-flex justify-content-between">
            <div class="row mt-2 mb-3 p-2">
                <h3 class="display-6 fw-bolder">Bancada 1</h3>
            </div>
            <div class="d-flex mt-2 p-2"><i class="azul-senac bi bi-send fs-3"></i></div>
        </div>

        <hr class="w-100 my-0 border-2 border-dark">
        <div class="conteudo d-flex justify-content-center">
            <div class="row mt-2 mb-3 p-2">
                <h3 class="display-6 fw-bolder">Estoque</h3>
            </div>
        </div>

        <!-- Listagem de Produtos -->
        <div>
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="row bg-light mt-3 text-center shadow-sm border-bottom border-2">
                        <div class="col">
                            <p class="mt-3 fw-bold"><?= htmlspecialchars($produto['nome']) ?></p>
                        </div>
                        <div class="col">
                            <p class="mt-3 fw-bold text">
                                <button onclick="atualizarEstoque(<?= $produto['id_produto'] ?>, 'incrementar')" class="btn btn-success btn-sm">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <span id="qtde-<?= $produto['id_produto'] ?>"><?= htmlspecialchars($produto['qtde']) ?></span>
                                <button onclick="atualizarEstoque(<?= $produto['id_produto'] ?>, 'decrementar')" class="btn btn-danger btn-sm">
                                    <i class="bi bi-dash"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="row bg-light mt-3 text-center shadow-sm border-bottom border-2">
                    <div class="col">
                        <p class="mt-3 fw-bold">Nenhum produto encontrado.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include("./footer.php"); ?>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css"></script>

    <script>
    function atualizarEstoque(idProduto, acao) {
        const formData = new FormData();
        formData.append('id_produto', idProduto);
        formData.append('acao', acao);
        formData.append('ajax', 'true');

        fetch(window.location.href, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`qtde-${idProduto}`).textContent = data.qtde;
            } else {
                alert('Erro ao atualizar o estoque: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
    }
    </script>
</body>

</html>
