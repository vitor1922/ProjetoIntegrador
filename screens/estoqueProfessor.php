<?php
// Start session for potential future authentication
session_start();
include('../constantes.php');
include_once("../data/conexao.php");
$perfil = $_SESSION['perfil'] ?? NULL;
$logado = $_SESSION['logado'] ?? NULL;
$nome = $_SESSION['nome'] ?? NULL;
$idUsuarioLogado = $_SESSION['id_usuario'] ?? null;

// Database connection
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=dbpisalao2024', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getProducts($offset = 0, $limit = 5) {
        $stmt = $this->pdo->prepare("SELECT * FROM produto LIMIT :offset, :limit");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM produto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM produto");
        return $stmt->fetchColumn();
    }

    public function getStockMovements() {
        $stmt = $this->pdo->query("SELECT * FROM estoque ORDER BY data_movimentacao DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStockMovement($id_produto, $qtde, $tipo_movimentacao) {
        $stmt = $this->pdo->prepare("INSERT INTO estoque (data_movimentacao, id_produto, qtde, tipo_movimentacao) VALUES (NOW(), :id_produto, :qtde, :tipo_movimentacao)");
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->bindValue(':qtde', $qtde);
        $stmt->bindValue(':tipo_movimentacao', $tipo_movimentacao);
        $stmt->execute();
        $this->updateProductQuantity($id_produto, $qtde, $tipo_movimentacao);
    }

    public function updateProductQuantity($id_produto, $qtde, $tipo_movimentacao) {
        if ($tipo_movimentacao == 'E') {
            $stmt = $this->pdo->prepare("UPDATE produto SET qtde_produto = qtde_produto + :qtde WHERE id_produto = :id_produto");
        } else {
            $stmt = $this->pdo->prepare("UPDATE produto SET qtde_produto = qtde_produto - :qtde WHERE id_produto = :id_produto");
        }
        $stmt->bindValue(':qtde', $qtde);
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->execute();
    }

    public function addProduct($nome, $descricao, $unidade, $qtde_min, $qtde_max, $qtde_produto) {
        $stmt = $this->pdo->prepare("INSERT INTO produto (nome, descricao, unidade, qtde_min, qtde_max, qtde_produto) VALUES (:nome, :descricao, :unidade, :qtde_min, :qtde_max, :qtde_produto)");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':unidade', $unidade);
        $stmt->bindValue(':qtde_min', $qtde_min);
        $stmt->bindValue(':qtde_max', $qtde_max);
        $stmt->bindValue(':qtde_produto', $qtde_produto);
        $stmt->execute();
    }

    public function updateProduct($id_produto, $nome, $descricao, $unidade, $qtde_min, $qtde_max, $qtde_produto) {
        $stmt = $this->pdo->prepare("UPDATE produto SET nome = :nome, descricao = :descricao, unidade = :unidade, qtde_min = :qtde_min, qtde_max = :qtde_max, qtde_produto = :qtde_produto WHERE id_produto = :id_produto");
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':unidade', $unidade);
        $stmt->bindValue(':qtde_min', $qtde_min);
        $stmt->bindValue(':qtde_max', $qtde_max);
        $stmt->bindValue(':qtde_produto', $qtde_produto);
        $stmt->execute();
    }

    public function deleteProduct($id_produto) {
        $stmt = $this->pdo->prepare("DELETE FROM produto WHERE id_produto = :id_produto");
        $stmt->bindValue(':id_produto', $id_produto);
        $stmt->execute();
    }
}

// Initialize database
$db = new Database();
$error_message = null;

// Pagination
$produto_por_pagina = 5;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $produto_por_pagina;
$total_produto = $db->getProductCount();
$total_paginas = ceil($total_produto / $produto_por_pagina);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Stock movement (entry or exit)
    if (isset($_POST['acao']) && $_POST['acao'] === 'movimentacao') {
        $id_produto = $_POST['id_produto'];
        $qtde = $_POST['qtde'];
        $tipo_movimentacao = $_POST['tipo_movimentacao'];
        
        try {
            $db->addStockMovement($id_produto, $qtde, $tipo_movimentacao);
        } catch (Exception $e) {
            $error_message = $e->getMessage();
        }
    }
    
    // Add product
    if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar_produto') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $unidade = $_POST['unidade'];
        $qtde_min = $_POST['qtde_min'];
        $qtde_max = $_POST['qtde_max'];
        $qtde_produto = $_POST['qtde_produto'];
        
        if (!in_array($unidade, ['g', 'ml', 'kg'])) {
            $error_message = "Erro: Unidade inválida. Use g, ml ou kg.";
        } else {
            $db->addProduct($nome, $descricao, $unidade, $qtde_min, $qtde_max, $qtde_produto);
        }
    }
    
    // Edit product
    // Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar produto
    if (isset($_POST['acao']) && $_POST['acao'] === 'adicionar_produto') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $unidade = $_POST['unidade'];
        $qtde_min = $_POST['qtde_min'];
        $qtde_max = $_POST['qtde_max'];
        $qtde_produto = $_POST['qtde_produto'];
        
        if (!in_array($unidade, ['g', 'ml', 'kg'])) {
            $error_message = "Erro: Unidade inválida. Use g, ml ou kg.";
        } else {
            $db->addProduct($nome, $descricao, $unidade, $qtde_min, $qtde_max, $qtde_produto);
            // Redirecionar ou atualizar a página para mostrar o novo produto
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}
    // Delete product
    if (isset($_POST['acao']) && $_POST['acao'] === 'excluir_produto') {
        $id_produto = $_POST['id_produto'];
        $db->deleteProduct($id_produto);
    }
}

// Get data for display
$produto = $db->getProducts($offset, $produto_por_pagina);
$all_produto = $db->getAllProducts(); // Para dropdowns
$movimentos = $db->getStockMovements();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Estoque</title>
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.css" class="">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header-title {
            text-align: center;
            margin: 20px 0;
            color: #2c3e50;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            font-weight: bold;
        }
        .list-group-item {
            background-color: #ffffff;
            margin-bottom: 8px;
            border-radius: 8px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.125);
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-success {
            background-color: #2ecc71;
            border: none;
        }
        .btn-success:hover {
            background-color: #27ae60;
        }
        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .btn-warning {
            background-color: #f39c12;
            border: none;
            color: white;
        }
        .btn-warning:hover {
            background-color: #d35400;
            color: white;
        }
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .pagination {
            justify-content: center;
        }
        .badge-entry {
            background-color: #d4edda;
            color: #155724;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .badge-exit {
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .stock-low {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        .stock-high {
            background-color: #fff3cd;
            color: #856404;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        .stock-ok {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }
        .navbar {
            background-color: #3498db;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div>
            <?php include_once("./header.php")?>
        </div>

    <div class="container my-4">
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($error_message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-success text-white">
                        <i class="bi bi-arrow-down-circle me-2"></i> Entrada de Estoque
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="entry_product" class="form-label">Produto</label>
                                <select id="entry_product" name="id_produto" class="form-select" required>
                                    <option value="">Selecione um produto</option>
                                    <?php foreach ($all_produto as $produto): ?>
                                        <option value="<?php echo htmlspecialchars($produto['id_produto']); ?>">
                                            <?php echo htmlspecialchars($produto['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="entry_quantity" class="form-label">Quantidade</label>
                                <input type="number" id="entry_quantity" name="qtde" class="form-control" required min="1">
                            </div>
                            <input type="hidden" name="tipo_movimentacao" value="E">
                            <input type="hidden" name="acao" value="movimentacao">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-plus-circle me-2"></i> Adicionar Entrada
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-danger text-white">
                        <i class="bi bi-arrow-up-circle me-2"></i> Saída de Estoque
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="exit_product" class="form-label">Produto</label>
                                <select id="exit_product" name="id_produto" class="form-select" required>
                                    <option value="">Selecione um produto</option>
                                    <?php foreach ($all_produto as $produto): ?>
                                        <option value="<?php echo htmlspecialchars($produto['id_produto']); ?>">
                                            <?php echo htmlspecialchars($produto['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exit_quantity" class="form-label">Quantidade</label>
                                <input type="number" id="exit_quantity" name="qtde" class="form-control" required min="1">
                            </div>
                            <input type="hidden" name="tipo_movimentacao" value="S">
                            <input type="hidden" name="acao" value="movimentacao">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-dash-circle me-2"></i> Adicionar Saída
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-clock-history me-2"></i> Movimentações Recentes
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach (array_slice($movimentos, 0, 5) as $movimento): ?>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="fw-bold"><?php echo htmlspecialchars($movimento['data_movimentacao']); ?></span>
                                <span>-</span>
                                <span><?php echo htmlspecialchars($movimento['data_movimentacao']); ?></span>
                                <span class="<?php echo $movimento['tipo_movimentacao'] == 'E' ? 'badge-entry' : 'badge-exit'; ?>">
                                    <?php echo $movimento['tipo_movimentacao'] == 'E' ? 'Entrada' : 'Saída'; ?>
                                </span>
                                <span class="fw-bold"><?php echo htmlspecialchars($movimento['qtde']); ?></span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-box me-2"></i> Lista de Produtos</span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-circle me-2"></i> Adicionar Produto
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Unidade</th>
                                <th>Qtde Min</th>
                                <th>Qtde Max</th>
                                <th>Qtde Atual</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($produto as $produtos): ?>
        <tr>
            <td><?php echo htmlspecialchars($produtos['id_produto']); ?></td>
            <td><?php echo htmlspecialchars($produtos['nome']); ?></td>
            <td><?php echo htmlspecialchars($produtos['descricao']); ?></td>
            <td><?php echo htmlspecialchars($produtos['unidade']); ?></td>
            <td><?php echo htmlspecialchars($produtos['qtde_min']); ?></td>
            <td><?php echo htmlspecialchars($produtos['qtde_max']); ?></td>
            <td>
                <span class="<?php 
                    if ($produtos['qtde_produto'] < $produtos['qtde_min']) {
                        echo 'stock-low';
                    } elseif ($produtos['qtde_produto'] > $produtos['qtde_max']) {
                        echo 'stock-high';
                    } else {
                        echo 'stock-ok';
                    }
                ?>">
                    <?php echo htmlspecialchars($produtos['qtde_produto']); ?>
                </span>
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm me-1" 
                        onclick="editProduct(<?php echo htmlspecialchars(json_encode($produtos)); ?>)">
                    <i class="bi bi-pencil"></i>
                </button>
                <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id_produto" value="<?php echo htmlspecialchars($produtos['id_produto']); ?>">
                    <input type="hidden" name="acao" value="excluir_produto">
                    <button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
                    </table>
                </div>
                
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item <?php echo $pagina_atual <= 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina_atual - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <li class="page-item <?php echo $pagina_atual >= $total_paginas ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $pagina_atual + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
    <footer class="footer text-center">
        <div class="container">
            <span>&copy; 2023 Sistema de Controle de Estoque</span>
        </div>
    </footer>
    
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2"></i> Adicionar Novo Produto
                    </h5>
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
                            <input type="text" class="form-control" id="descricao" name="descricao">
                        </div>
                        <div class="mb-3">
                            <label for="unidade" class="form-label">Unidade</label>
                            <select class="form-select" id="unidade" name="unidade" required>
                                <option value="g">g</option>
                                <option value="ml">ml</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="qtde_min" class="form-label">Quantidade Mínima</label>
                            <input type="number" class="form-control" id="qtde_min" name="qtde_min" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="qtde_max" class="form-label">Quantidade Máxima</label>
                            <input type="number" class="form-control" id="qtde_max" name="qtde_max" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="qtde_produto" class="form-label">Quantidade Inicial</label>
                            <input type="number" class="form-control" id="qtde_produto" name="qtde_produto" required min="0">
                        </div>
                        <input type="hidden" name="acao" value="adicionar_produto">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i> Adicionar Produto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil me-2"></i> Editar Produto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" id="edit_id_produto" name="id_produto">
                        <div class="mb-3">
                            <label for="edit_nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="edit_nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_descricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="edit_descricao" name="descricao">
                        </div>
                        <div class="mb-3">
                            <label for="edit_unidade" class="form-label">Unidade</label>
                            <select class="form-select" id="edit_unidade" name="unidade" required>
                                <option value="g">g</option>
                                <option value="ml">ml</option>
                                <option value="kg">kg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_qtde_min" class="form-label">Quantidade Mínima</label>
                            <input type="number" class="form-control" id="edit_qtde_min" name="qtde_min" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="edit_qtde_max" class="form-label">Quantidade Máxima</label>
                            <input type="number" class="form-control" id="edit_qtde_max" name="qtde_max" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="edit_qtde_produto" class="form-label">Quantidade Atual</label>
                            <input type="number" class="form-control" id="edit_qtde_produto" name="qtde_produto" required min="0">
                        </div>
                        <input type="hidden" name="acao" value="editar_produto">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-2"></i> Salvar Alterações
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <?php 
        include_once("./footer.php")
        ?>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function editProduct(product) {
            document.getElementById('edit_id_produto').value = product.id_produto;
            document.getElementById('edit_nome').value = product.nome;
            document.getElementById('edit_descricao').value = product.descricao;
            document.getElementById('edit_unidade').value = product.unidade;
            document.getElementById('edit_qtde_min').value = product.qtde_min;
            document.getElementById('edit_qtde_max').value = product.qtde_max;
            document.getElementById('edit_qtde_produto').value = product.qtde_produto;
            
            const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
            editModal.show();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>