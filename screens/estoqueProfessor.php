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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        // Atualiza a lista de itens após a inserção
        $query = "SELECT e.*, p.nome FROM estoque e JOIN produto p ON e.id_produto = p.id_produto ORDER BY e.data_movimentacao DESC";
        $stmt = $conexao->prepare($query);
        $stmt->execute();
        $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error_message = "Erro ao adicionar movimentação: " . $stmt->errorInfo()[2];
    }
}
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
                                    <?php
                                    // Consultar produtos da tabela 'produto'
                                    $produtos_query = "SELECT * FROM produto";
                                    $stmt = $conexao->prepare($produtos_query);
                                    $stmt->execute();
                                    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($produtos as $produto) {
                                        echo '<option value="' . htmlspecialchars($produto['id_produto']) . '">' . htmlspecialchars($produto['nome']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="qtde" placeholder="Quantidade" required class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="status" value="entrada">
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
                                    <?php
                                    // Reutilizar a mesma consulta de produtos
                                    foreach ($produtos as $produto) {
                                        echo '<option value="' . htmlspecialchars($produto['id_produto']) . '">' . htmlspecialchars($produto['nome']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="qtde" placeholder="Quantidade" required class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="status" value="saida">
                        <button type="submit" class="btn btn-primary mt-3">Adicionar Saída</button>
                    </form>
                </div>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>

            <!-- Lista de itens do estoque -->
            <h3>Itens do Estoque</h3>
            <div class="list-group mb-4">
                <?php foreach ($itens as $item): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center mb-3">
                        <strong><?= htmlspecialchars(date('d/m/Y H:i:s', strtotime($item['data_movimentacao']))) ?></strong>
                        <strong><?= htmlspecialchars($item['nome']) ?></strong>
                        <strong>• <?= htmlspecialchars($item['qtde']) ?> •</strong>
                        <strong><?= htmlspecialchars(ucfirst($item['status'])) ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Lista de produtos disponíveis -->
            <h3>Produtos Disponíveis</h3>
            <div class="row">
                <?php foreach ($produtos as $produto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card p-3">
                            <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
                            <p class="card-text">Descrição: <?= htmlspecialchars($produto['descricao']) ?></p>
                            <p class="card-text">Unidade: <?= htmlspecialchars($produto['unidade']) ?></p>
                            <p class="card-text">Quantidade Mínima: <?= htmlspecialchars($produto['qtde_min']) ?></p>
                            <p class="card-text">Quantidade Máxima: <?= htmlspecialchars($produto['qtde_max']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <?php include("./footer.php"); ?>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
