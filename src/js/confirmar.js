// JS DO CAVERA, LINKADO NA PÁGINA horariosInstrutor. NÃO APAGAR!

document.addEventListener('DOMContentLoaded', (event) => {
    var concluirButtons = document.querySelectorAll('.btn-concluir');
    concluirButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var form = this.closest('form');
            var confirmYesButton = document.getElementById('confirmYes');
            
            var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
            
            confirmYesButton.onclick = function() {
                form.submit();
            };
        });
    });
});
