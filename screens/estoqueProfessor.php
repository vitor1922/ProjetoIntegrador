<?php
include_once("../constantes.php");
include_once('../data/conexao.php');

$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;

// Consulta para obter itens do estoque
$query = "SELECT e.*, p.nome FROM estoque e JOIN produto p ON e.id_produto = p.id_produto ORDER BY e.data_movimentacao DESC";
$stmt = $conexao->prepare($query);
$stmt->execute();
$itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Separar itens de entrada e saída
$entradas = array_filter($itens, function($item) {
    return $item['status'] === 'entrada';
});
$saidas = array_filter($itens, function($item) {
    return $item['status'] === 'saida';
});

// Verifica se o formulário foi enviado para movimentação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'movimentacao') {
    $id_produto = $_POST['id_produto'];
    $qtde = $_POST['qtde'];
    $status = $_POST['status'];

    // Inserir movimentação no estoque
    $query = "INSERT INTO estoque (data_movimentacao, id_produto, qtde, status) VALUES (NOW(), :id_produto, :qtde, :status)";
    $stmt = $conexao->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':qtde', $qtde);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        // Atualiza a quantidade do produto no banco de dados
        if ($status === 'entrada') {
            $query = "UPDATE produto SET qtde_produto = qtde_produto + :qtde WHERE id_produto = :id_produto";
        } else {
            $query = "UPDATE produto SET qtde_produto = qtde_produto - :qtde WHERE id_produto = :id_produto";
        }

        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':qtde', $qtde);
        
        if (!$stmt->execute()) {
            $error_message = "Erro ao atualizar quantidade do produto: " . $stmt->errorInfo()[2];
        }
        
        // Atualiza a lista de itens após a inserção
        $query = "SELECT e.*, p.nome FROM estoque e JOIN produto p ON e.id_produto = p.id_produto ORDER BY e.data_movimentacao DESC";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Re-split the items into entradas e saidas
        $entradas = array_filter($itens, function($item) {
            return $item['status'] === 'entrada';
        });
        $saidas = array_filter($itens, function($item) {
            return $item['status'] === 'saida';
        });
    } else {
        $error_message = "Erro ao adicionar movimentação: " . $stmt->errorInfo()[2];
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

    // Inserir produto na tabela 'produto'
    $query = "INSERT INTO produto (nome, descricao, unidade, qtde_min, qtde_max, qtde_produto) VALUES (:nome, :descricao, :unidade, :qtde_min, :qtde_max, :qtde_produto)";
    $stmt = $conexao->prepare($query);

    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':unidade', $unidade);
    $stmt->bindParam(':qtde_min', $qtde_min);
    $stmt->bindParam(':qtde_max', $qtde_max);
    $stmt->bindParam(':qtde_produto', $qtde_produto);

    if ($stmt->execute()) {
        // Atualiza a lista de produtos após a inserção
        $produtos_query = "SELECT * FROM produto";
        $stmt = $conexao->prepare($produtos_query);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error_message = "Erro ao adicionar produto: " . $stmt->errorInfo()[2];
    }
}

// Consulta produtos da tabela 'produto'
$produtos_query = "SELECT * FROM produto";
$stmt = $conexao->prepare($produtos_query);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f2f2f2;
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
    </style>
</head>

<body class="d-flex justify-content-between flex-column container-fluid min-vh-100 p-0">
    <?php include_once("./header.php"); ?>

    <main>
        <div class="container my-5">
            <h2 class="header-title fw-bold">Controle de Estoque</h2>

            <div class="row">
                <!-- Seção de Entrada -->
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
                        <input type="hidden" name="status" value="entrada">
                        <input type="hidden" name="acao" value="movimentacao">
                        <button type="submit" class="btn btn-primary mt-3">Adicionar Entrada</button>
                    </form>
                </div>

                <!-- Seção de Saída -->
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
                        <input type="hidden" name="status" value="saida">
                        <input type="hidden" name="acao" value="movimentacao">
                        <button type="submit" class="btn btn-primary mt-3">Adicionar Saída</button>
                    </form>
                </div>
            </div>

            <div class="my-5">
                <h4 class="fw-bold">Movimentações de Estoque</h4>
                <h5>Entradas</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entradas as $entrada): ?>
                            <tr>
                                <td><?= htmlspecialchars($entrada['data_movimentacao']) ?></td>
                                <td><?= htmlspecialchars($entrada['nome']) ?></td>
                                <td><?= htmlspecialchars($entrada['qtde']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h5>Saídas</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($saidas as $saida): ?>
                            <tr>
                                <td><?= htmlspecialchars($saida['data_movimentacao']) ?></td>
                                <td><?= htmlspecialchars($saida['nome']) ?></td>
                                <td><?= htmlspecialchars($saida['qtde']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h4 class="fw-bold">Produtos Disponíveis</h4>

            <!-- Botão para abrir o modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionarProduto">
                Adicionar Produto
            </button>

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
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" id="descricao" name="descricao" required>
                                </div>
                                <div class="mb-3">
                                    <label for="unidade" class="form-label">Unidade</label>
                                    <input type="text" class="form-control" id="unidade" name="unidade" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_min" class="form-label">Quantidade Mínima</label>
                                    <input type="number" class="form-control" id="qtde_min" name="qtde_min" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_max" class="form-label">Quantidade Máxima</label>
                                    <input type="number" class="form-control" id="qtde_max" name="qtde_max" required>
                                </div>
                                <div class="mb-3">
                                    <label for="qtde_produto" class="form-label">Quantidade Atual</label>
                                    <input type="number" class="form-control" id="qtde_produto" name="qtde_produto" required>
                                </div>
                                <input type="hidden" name="acao" value="adicionar_produto">
                                <button type="submit" class="btn btn-primary">Adicionar Produto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
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
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td><?= htmlspecialchars($produto['descricao']) ?></td>
                            <td><?= htmlspecialchars($produto['unidade']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_min']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_max']) ?></td>
                            <td><?= htmlspecialchars($produto['qtde_produto']) ?></td>
                            <td>
                                <div class="d-flex">
                                    <form action="" method="POST" style="margin-right: 5px;">
                                        <input type="hidden" name="id_produto" value="<?= htmlspecialchars($produto['id_produto']) ?>">
                                        <input type="hidden" name="acao" value="excluir_produto">
                                        <button type="submit" class="btn btn-danger btn-sm" title="Excluir Produto">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-warning btn-sm" title="Editar Produto" data-bs-toggle="modal" data-bs-target="#modalEditarProduto<?= $produto['id_produto'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal para Editar Produto -->
                        <div class="modal fade" id="modalEditarProduto<?= $produto['id_produto'] ?>" tabindex="-1" aria-labelledby="modalEditarProdutoLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditarProdutoLabel">Editar Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_produto" value="<?= htmlspecialchars($produto['id_produto']) ?>">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descricao" class="form-label">Descrição</label>
                                                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="unidade" class="form-label">Unidade</label>
                                                <input type="text" class="form-control" id="unidade" name="unidade" value="<?= htmlspecialchars($produto['unidade']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="qtde_min" class="form-label">Quantidade Mínima</label>
                                                <input type="number" class="form-control" id="qtde_min" name="qtde_min" value="<?= htmlspecialchars($produto['qtde_min']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="qtde_max" class="form-label">Quantidade Máxima</label>
                                                <input type="number" class="form-control" id="qtde_max" name="qtde_max" value="<?= htmlspecialchars($produto['qtde_max']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="qtde_produto" class="form-label">Quantidade Atual</label>
                                                <input type="number" class="form-control" id="qtde_produto" name="qtde_produto" value="<?= htmlspecialchars($produto['qtde_produto']) ?>" required>
                                            </div>
                                            <input type="hidden" name="acao" value="editar_produto">
                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once("./footer.php"); ?>
    
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
