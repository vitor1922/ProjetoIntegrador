<?php
include_once("../constantes.php");
?>
<!-- Modal de Recuperação de Senha -->

<div class="modal fade" id="modalRecuperacao" tabindex="-1" aria-labelledby="modalRecuperacaoLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRecuperacaoLabel"> Recuperação de Senha </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p>Digite seu e-mail para recuperar sua senha.</p>
                <form action="logicaSenhaRedfinir.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Link de Recuperação</button>
                </form>
            </div>
        </div>
    </div>
</div>
