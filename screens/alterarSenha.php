<?php
    include_once("../constantes.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="../src/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include_once("./header.php"); ?>
    
    <main>
        <div id="main" class="d-flex justify-content-center align-items-center"> <!-- Retirado os vh-100 vw-100-->
            <div class="col-md-4 p-3 rounded">
                <a href=""><img class="mb-2 font-size" src="../src/bootstrap/bootstrap-icons/icons/arrow-left.svg" alt="Voltar"></a>
                <h5 class="text-start mb-4 text-warning">Alterar Senha</h5>
                <hr class="border-warning" style="border-width: 2px;">
                
                <form id="updateForm" action="processar_alteracao.php" method="post">
                    <div class="form-group mt-4 d-flex">
                        <div style="flex: 1;">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control bg-light" id="email" name="email" placeholder="Digite seu e-mail" required>
                        </div>
                    </div>
                    <div class="form-group mt-4 d-flex">
                        <div style="flex: 1;">
                            <label for="password" class="form-label">Senha Atual</label>
                            <input type="text" class="form-control bg-light" id="password" name="password" placeholder="Digite sua Senha Atual" required>
                        </div>
                    </div>
                    <div class="form-group mt-4 d-flex">
                        <div style="flex: 1;">
                            <label for="newPassword" class="form-label">Nova Senha</label>
                            <input type="string" class="form-control bg-light" id="newPassword" name="newPassword" placeholder="Digite sua Nova Senha" required>
                        </div>
                    </div>
                    <div class="alert alert-warning mt-3" role="alert">
                        <strong>Por favor, confirme a senha antes de alterá-la!</strong>
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-primary btn-block mt-3" data-bs-toggle="modal" data-bs-target="#confirmUpdate">Alterar Senha</button>
                    </div>
                </form>

                <!-- Modal de Confirmação -->
                <div class="modal fade" id="confirmUpdate" tabindex="-1" aria-labelledby="confirmUpdateLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmUpdateLabel">Confirmar Alteração</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza de que deseja alterar sua senha? <strong><u>Esta ação pode afetar suas configurações de conta!</u></strong>.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="confirmButton">Alterar</button>
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
        const updateForm = document.getElementById('updateForm');
        
        confirmButton.addEventListener('click', function() {
            updateForm.submit(); // Envia o formulário após confirmação
        });
    </script>
    <?php include_once("./footer.php"); ?>
</body>

</html>
