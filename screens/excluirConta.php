<?php
    include_once("../constantes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <title>Excluir Conta</title>
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include_once("./header.php"); ?>
    
    <main>
        <div id="main" class="d-flex justify-content-center align-items-center vh-100 vw-100">
            <div class="col-md-4 p-3 rounded">
                <a href=""><img class="mb-2 font-size" src="../src/bootstrap/bootstrap-icons/icons/arrow-left.svg" alt="Voltar"></a>
                <h5 class="text-start mb-4 text-warning">Excluir Conta</h5>
                <hr class="border-warning" style="border-width: 2px;">
                
                <form id="deleteForm" action="processar_exclusao.php" method="post">
                    <div class="form-group mt-4">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control bg-light" id="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>ESTA AÇÃO É IRREVERSÍVEL!!!<strong>
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-danger btn-block mt-3" data-bs-toggle="modal" data-bs-target="#confirmDelete">Excluir Conta</button>
                    </div>
                </form>

                <!-- Modal de Confirmação -->
                <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza de que deseja excluir sua conta? <strong><u>ESTA AÇÃO É IRREVERSÍVEL!!!<u><strong>.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="confirmButton">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../src/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const confirmButton = document.getElementById('confirmButton');
        const deleteForm = document.getElementById('deleteForm');
        
        confirmButton.addEventListener('click', function() {
            deleteForm.submit(); // Envia o formulário após confirmação
        });
    </script>
        <?php include_once("./footer.php"); ?>
</body>

</html>
