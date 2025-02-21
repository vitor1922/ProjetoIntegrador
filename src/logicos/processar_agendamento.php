<?php
session_start();

# Inicia as variáveis de sessão e inclui constantes e conexão
include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Verifica se o ID da agenda foi enviado
    if (!empty($_POST['id_agenda'])) {
        // Filtra e sanitiza o ID da agenda
        $idAgenda = filter_input(INPUT_POST, "id_agenda", FILTER_SANITIZE_NUMBER_INT);

        try {
            // Busca a data, hora e ID da tabela `agenda`
            $sqlBuscaAgenda = "SELECT id_agenda, data, hora, id_usuario, id_turma, id_aluno  FROM agenda WHERE id_agenda = :id_agenda";
            $stmtBuscaAgenda = $conexao->prepare($sqlBuscaAgenda);
            $stmtBuscaAgenda->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
            $stmtBuscaAgenda->execute();

            $agenda = $stmtBuscaAgenda->fetch(PDO::FETCH_ASSOC);

            if ($agenda) {
                // Extrai os dados da agenda
                $dataAgenda = $agenda['data']; // Data da tabela `agenda`
                $horaAgenda = $agenda['hora']; // Hora da tabela `agenda`
                $idAgenda = $agenda['id_agenda']; // ID da agenda
                $alunoAgenda = $agenda[]

                // Insere os dados na tabela `agendamento`
                $sqlInsert = "INSERT INTO agendamento (data, hora, id_agenda) 
                              VALUES (:data, :hora, :id_agenda)";
                $insert = $conexao->prepare($sqlInsert);
                $insert->bindParam(":data", $dataAgenda);
                $insert->bindParam(":hora", $horaAgenda);
                $insert->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);

                if ($insert->execute()) {
                    echo "Agendamento realizado com sucesso!<br>";
                    echo "Data: " . $dataAgenda . "<br>";
                    echo "Hora: " . $horaAgenda . "<br>";
                    echo "ID da Agenda: " . $idAgenda . "<br>";
                } else {
                    throw new Exception("Erro ao realizar o agendamento.");
                }
            } else {
                throw new Exception("Agenda não encontrada.");
            }
        } catch (Exception $e) {
            echo "Ocorreu um erro: " . $e->getMessage();
        } finally {
            // Fecha a conexão com o banco de dados
            unset($conexao);
        }
    } else {
        echo "ID da agenda não foi fornecido.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>