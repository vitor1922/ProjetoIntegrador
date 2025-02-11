<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'horario' foi enviado
    if (isset($_POST['horario'])) {
        $horarioSelecionado = $_POST['horario'];

        // Exibe o horário selecionado
        echo "Horário selecionado: " . htmlspecialchars($dataFormatada-);

        // Aqui você pode adicionar a lógica para salvar no banco de dados, etc.
    } else {
        echo "Nenhum horário foi selecionado.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>