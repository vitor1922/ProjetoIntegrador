<?php
include_once("../constantes.php");
include_once('../data/conexao.php');

$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

// Definindo o número de produtos por página
$produtos_por_pagina = 5; // Alterado para 5 produtos por página
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $produtos_por_pagina;

// Consulta para obter itens do estoque
$query = "SELECT e.*, p.nome FROM estoque e JOIN produto p ON e.id_produto = p.id_produto ORDER BY p.nome ASC LIMIT :offset, :limit";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $produtos_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consulta para contar o total de produtos
$query_total = "SELECT COUNT(*) as total FROM produto";
$stmt_total = $conexao->prepare($query_total);
$stmt_total->execute();
$total_produtos = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
$total_paginas = ceil($total_produtos / $produtos_por_pagina);

// Função para obter o saldo atual de um produto
function obterSaldoProduto($conexao, $id_produto) {
    $query = "SELECT qtde_produto FROM produto WHERE id_produto = :id_produto";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado ? $resultado['qtde_produto'] : 0;
}

// Verifica se o formulário foi enviado para movimentação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'movimentacao') {
    $id_produto = $_POST['id_produto'];
    $qtde = $_POST['qtde'];
    $tipo_movimentacao = $_POST['tipo_movimentacao'] ?? null;

    // Check if the quantity to remove exceeds the available stock
    if ($tipo_movimentacao === 'S' && $qtde > obterSaldoProduto($conexao, $id_produto)) {
        $error_message = "Erro: A quantidade a ser removida excede o estoque disponível.";
    } else {
        // Inserir movimentação no estoque
        $query = "INSERT INTO estoque (data_movimentacao, id_produto, qtde, tipo_movimentacao) VALUES (NOW(), :id_produto, :qtde, :tipo_movimentacao)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':qtde', $qtde);
        $stmt->bindParam(':tipo_movimentacao', $tipo_movimentacao);

        if ($stmt->execute()) {
            if ($tipo_movimentacao === 'E') {
                $query = "UPDATE produto SET qtde_produto = qtde_produto + :qtde WHERE id_produto = :id_produto";
            } elseif ($tipo_movimentacao === 'S') {
                $query = "UPDATE produto SET qtde_produto = qtde_produto - :qtde WHERE id_produto = :id_produto";
            }

            if (isset($query)) {
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':id_produto', $id_produto);
                $stmt->bindParam(':qtde', $qtde);
                if (!$stmt->execute()) {
                    $error_message = "Erro ao atualizar quantidade do produto: " . $stmt->errorInfo()[2];
                }
            }

            // Atualiza a lista de itens após a inserção
            $query = "SELECT e.*, p.nome FROM estoque e JOIN produto p ON e.id_produto = p.id_produto ORDER BY e.data_movimentacao DESC";
            $stmt = $conexao->prepare($query);
            $stmt->execute();
            $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $error_message = "Erro ao adicionar movimentação: " . $stmt->errorInfo()[2];
        }
    }
}

// Verifica se o formulário foi enviado para adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'adicionar_produto') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $unidade = $_POST['unidade'];
    $qtde_min = $_POST['qtde_min'];
    $qtde_max = $_POST['qtde_max'];
    $qtde_produto = $_POST['qtde_produto'];

    // Verifica se a unidade é válida
    if (!in_array($unidade, ['g', 'ml', 'kg'])) {
        $error_message = "Erro: Unidade inválida. Use g, ml ou kg.";
    } else {
        // Inserir produto na tabela 'produto'
        $query = "INSERT INTO produto (nome, descricao, unidade, qtde_min, qtde_max, qtde_produto) VALUES (:nome, :descricao, :unidade, :qtde_min, :qtde_max, :qtde_produto)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':unidade', $unidade);
        $stmt->bindParam(':qtde_min', $qtde_min);
        $stmt->bindParam(':qtde_max', $qtde_max);
        $stmt->bindParam(':qtde_produto', $qtde_produto);

        if ($stmt->execute()) {
            // Atualiza a lista de produtos
            $produtos_query = "SELECT * FROM produto ORDER BY nome ASC LIMIT :offset, :limit";
            $stmt = $conexao->prepare($produtos_query);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $produtos_por_pagina, PDO::PARAM_INT);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $error_message = "Erro ao adicionar produto: " . $stmt->errorInfo()[2];
        }
    }
}

// Verifica se o formulário foi enviado para editar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editar_produto') {
    $id_produto = $_POST['id_produto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $unidade = $_POST['unidade'];
    $qtde_min = $_POST['qtde_min'];
    $qtde_max = $_POST['qtde_max'];
    $qtde_produto = $_POST['qtde_produto'];

    // Atualizar produto na tabela 'produto'
    $query = "UPDATE produto SET nome = :nome, descricao = :descricao, unidade = :unidade, qtde_min = :qtde_min, qtde_max = :qtde_max, qtde_produto = :qtde_produto WHERE id_produto = :id_produto";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':unidade', $unidade);
    $stmt->bindParam(':qtde_min', $qtde_min);
    $stmt->bindParam(':qtde_max', $qtde_max);
    $stmt->bindParam(':qtde_produto', $qtde_produto);

    if ($stmt->execute()) {
        // Atualiza a lista de produtos
        $produtos_query = "SELECT * FROM produto ORDER BY nome ASC LIMIT :offset, :limit";
        $stmt = $conexao->prepare($produtos_query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $produtos_por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error_message = "Erro ao editar produto: " . $stmt->errorInfo()[2];
    }
}

// Verifica se o formulário foi enviado para excluir produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'excluir_produto') {
    $id_produto = $_POST['id_produto'];

    // Excluir produto da tabela 'produto'
    $query = "DELETE FROM produto WHERE id_produto = :id_produto";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_produto', $id_produto);

    if ($stmt->execute()) {
        // Atualiza a lista de produtos
        $produtos_query = "SELECT * FROM produto ORDER BY nome ASC LIMIT :offset, :limit";
        $stmt = $conexao->prepare($produtos_query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $produtos_por_pagina, PDO::PARAM_INT);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error_message = "Erro ao excluir produto: " . $stmt->errorInfo()[2];
    }
}

// Consulta produtos da tabela 'produto'
$produtos_query = "SELECT * FROM produto ORDER BY nome ASC LIMIT :offset, :limit";
$stmt = $conexao->prepare($produtos_query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':limit', $produtos_por_pagina, PDO::PARAM_INT);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área do Instrutor - Estoque</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .header-title {
            text-align: center;
            margin: 20px 0;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .list-group-item {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .modal-content {
            border-radius: 10px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .pagination {
            justify-content: center;
        }
        
    </style>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">
    <?php include_once("./header.php"); ?>

    <main>
        <div class="container my-5">
            <h2 class="header-title fw-bold">Controle de Estoque</h2>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="fw-bold">Entrada</h4>
                    <form action="" method="POST" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="id_produto" required class="form-control">
                                    <option value="">Selecione um produto</option>
                                    <?php foreach ($produtos as $produto): ?>
                                        <option value="<?= htmlspecialchars($produto['id_produto']) ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="qtde" placeholder="Quantidade" required class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="tipo_movimentacao" value="E">
                        <input type="hidden" name="acao" value="movimentacao">
                        <button type="submit" class="btn btn-primary mt-3">Adicionar Entrada</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h4 class="fw-bold">Saída</h4>
                    <form action="" method="POST" class="mb-4">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="id_produto" required class="form-control">
                                    <option value="">Selecione um produto</option>
                                    <?php foreach ($produtos as $produto): ?>
                                        <option value="<?= htmlspecialchars($produto['id_produto']) ?>"><?= htmlspecialchars($produto['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="qtde" placeholder="Quantidade" required class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="tipo_movimentacao" value="S">
                        <input type="hidden" name="acao" value="movimentacao">
                        <button type="submit" class="btn btn-danger mt-3">Adicionar Saída</button>
                    </form>
                </div>
            </div>

            <h4 class="fw-bold mt-5">Movimentações Recentes</h4>
            <ul class="list-group">
                <?php foreach ($itens as $item): ?>
                    <li class="list-group-item">
                        <?= htmlspecialchars($item['data_movimentacao']) ?> - <?= htmlspecialchars($item['nome']) ?>
                        (<?= htmlspecialchars($item['tipo_movimentacao']) ?>): <?= htmlspecialchars($item['qtde']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
            <?php endif; ?>

            <h4 class="fw-bold mt-5">Lista de Produtos</h4>
            <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#modalAdicionarProduto">
                Adicionar Produto
            </button>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Unidade</th>
                        <th>Quantidade Mínima</th>
                        <th>Quantidade Máxima</th>
                        <th>Quantidade Atual</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= htmlspecialchars($produto['id_produto']) ?></td>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($produto['descricao']) ?></td>
                            <td><?= htmlspecialchars($produto['unidade']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_min']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_max']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_produto']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarProduto(<?= htmlspecialchars($produto['id_produto']) ?>, '<?= htmlspecialchars($produto['nome']) ?>', '<?= htmlspecialchars($produto['descricao']) ?>', '<?= htmlspecialchars($produto['unidade']) ?>', <?= htmlspecialchars($produto['qtde_min']) ?>, <?= htmlspecialchars($produto['qtde_max']) ?>, <?= htmlspecialchars($produto['qtde_produto']) ?>)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_produto" value="<?= htmlspecialchars($produto['id_produto']) ?>">
                                    <input type="hidden" name="acao" value="excluir_produto">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Paginação -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $pagina_atual == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?= $i == $pagina_atual ? 'active' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $pagina_atual == $total_paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="?pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Modal para Adicionar Produto -->
            <div class="modal fade" id="modalAdicionarProduto" tabindex="-1" aria-labelledby="modalAdicionarProdutoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAdicionarProdutoLabel">Adicionar Novo Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="unidade" class="form-label">Unidade</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control">
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_min" class="form-label">Quantidade Mínima</label>
                                    <input type="number" name="qtde_min" id="qtde_min" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_max" class="form-label">Quantidade Máxima</label>
                                    <input type="number" name="qtde_max" id="qtde_max" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_produto" class="form-label">Quantidade Inicial</label>
                                    <input type="number" name="qtde_produto" id="qtde_produto" class="form-control" required>
                                </div>
                                <input type="hidden" name="acao" value="adicionar_produto">
                                <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Produto -->
            <div class="modal fade" id="modalEditarProduto" tabindex="-1" aria-labelledby="modalEditarProdutoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarProdutoLabel">Editar Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id_produto" id="edit_id_produto">
                                <div class="mb-3">
                                    <label for="edit_nome" class="form-label">Nome</label>
                                    <input type="text" name="nome" id="edit_nome" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_descricao" class="form-label">Descrição</label>
                                    <input type="text" name="descricao" id="edit_descricao" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="unidade" class="form-label">Unidade</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control">
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_qtde_min" class="form-label">Quantidade Mínima</label>
                                    <input type="number" name="qtde_min" id="edit_qtde_min" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_qtde_max" class="form-label">Quantidade Máxima</label>
                                    <input type="number" name="qtde_max" id="edit_qtde_max" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_qtde_produto" class="form-label">Quantidade Atual</label>
                                    <input type="number" name="qtde_produto" id="edit_qtde_produto" class="form-control" required>
                                </div>
                                <input type="hidden" name="acao" value="editar_produto">
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>

    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarProduto(id, nome, descricao, unidade, qtde_min, qtde_max, qtde_produto) {
            document.getElementById('edit_id_produto').value = id;
            document.getElementById('edit_nome').value = nome;
            document.getElementById('edit_descricao').value = descricao;
            document.getElementById('edit_unidade').value = unidade;
            document.getElementById('edit_qtde_min').value = qtde_min;
            document.getElementById('edit_qtde_max').value = qtde_max;
            document.getElementById('edit_qtde_produto').value = qtde_produto;
            var myModal = new bootstrap.Modal(document.getElementById('modalEditarProduto'));
            myModal.show();
        }
    </script>
</body>

</html>