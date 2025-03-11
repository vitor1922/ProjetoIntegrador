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
            $sqlBuscaAgenda = "SELECT id_agenda, data, hora, id_usuario, id_turma 
            FROM agenda
            WHERE id_agenda = :id_agenda";
            $stmtBuscaAgenda = $conexao->prepare($sqlBuscaAgenda);
            $stmtBuscaAgenda->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
            $stmtBuscaAgenda->execute();

            $agenda = $stmtBuscaAgenda->fetch(PDO::FETCH_ASSOC);

            if ($agenda) {
                // Extrai os dados da agenda
                $dataAgenda = $agenda['data']; // Data da tabela `agenda`
                $horaAgenda = $agenda['hora']; // Hora da tabela `agenda`
                $idAgenda = $agenda['id_agenda']; // ID da agenda
                $clienteAgenda = $agenda['id_usuario'];
                $turmaAgenda = $agenda['id_turma'];

                // Insere os dados na tabela `agendamento`
                $sqlInsert = "INSERT INTO agendamento (data, hora, id_agenda, id_usuario, id_turma) 
                              VALUES (:data, :hora, :id_agenda, :id_usuario, :id_turma)";
                $insert = $conexao->prepare($sqlInsert);
                $insert->bindParam(":data", $dataAgenda);
                $insert->bindParam(":hora", $horaAgenda);
                $insert->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
                $insert->bindParam(":id_usuario", $clienteAgenda, PDO::PARAM_INT);
                $insert->bindParam(":id_turma", $turmaAgenda, PDO::PARAM_INT);
                

                if ($insert->execute()) {
                    $_SESSION['mensagem'] = [
                        'tipo' => 'success',
                        'texto' => 'Agendamento realizado com sucesso!'
                    ];
                } else {
                    throw new Exception("Erro ao realizar o agendamento.");
                }
            } else {
                throw new Exception("Agenda não encontrada.");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = [
                'tipo' => 'danger',
                'texto' => 'Erro: ' . $e->getMessage()
            ];
        } finally {
            // Redireciona de volta para a página de agendamento
            header('Location: ../../screens/agendamento.php');
            exit();
        }
    } else {
        $_SESSION['mensagem'] = [
            'tipo' => 'warning',
            'texto' => 'ID da agenda não foi fornecido.'
        ];
        header('Location: ../../screens/agendamento.php');
        exit();
    }
} else {
    $_SESSION['mensagem'] = [
        'tipo' => 'danger',
        'texto' => 'Método de requisição inválido.'
    ];
    header('Location: ../../screens/agendamento.php');
    exit();
}
?>