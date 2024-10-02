<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Controle de Estoque Salão De Beleza Senac</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div>
                <h1>Controle de Estoque Salão De Beleza Senac</h1>
            </div>
            <div class="w-25 h-25">
                <img class="img-fluid" src="../assets/img/logoSenac.png" alt="Logo Senac">
            </div>
        </div>  
        <form id="estoqueForm">
            <input type="text" id="produto" placeholder="Nome do Produto" required>
            <input type="number" id="quantidade" placeholder="Quantidade" required min="1">
            <button type="submit">Adicionar</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody id="estoqueTabela">
                <!-- Produtos serão adicionados aqui -->
            </tbody>
        </table>
    </div>
    <script src="../src/js/script.js"></script>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
