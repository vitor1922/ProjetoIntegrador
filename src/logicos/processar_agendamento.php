<?php
session_start();
include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['id_agenda'])) {
        $idAgenda = filter_input(INPUT_POST, "id_agenda", FILTER_SANITIZE_NUMBER_INT);
        $conexao->beginTransaction();

        try {
            
            $sqlVerificaVagas = "
                SELECT 
                    (1 - COUNT(ag.id_agendamento)) AS vagas_restantes
                FROM agenda a
                LEFT JOIN agendamento ag ON a.id_agenda = ag.id_agenda
                WHERE a.id_agenda = :id_agenda
                GROUP BY a.id_agenda
            ";
        
            $stmtVerifica = $conexao->prepare($sqlVerificaVagas);
            $stmtVerifica->bindParam(':id_agenda', $idAgenda, PDO::PARAM_INT);
            $stmtVerifica->execute();
            $resultado = $stmtVerifica->fetch(PDO::FETCH_ASSOC);
        
            if (!$resultado || $resultado['vagas_restantes'] <= 0) {
                throw new Exception("Não há vagas disponíveis para este horário.");
            }

            
            $sqlBuscaAgenda = "SELECT id_agenda, data, hora, id_usuario, id_turma 
                               FROM agenda 
                               WHERE id_agenda = :id_agenda";
            $stmtBuscaAgenda = $conexao->prepare($sqlBuscaAgenda);
            $stmtBuscaAgenda->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
            $stmtBuscaAgenda->execute();
            $agenda = $stmtBuscaAgenda->fetch(PDO::FETCH_ASSOC);

            if (!$agenda) {
                throw new Exception("Agenda não encontrada.");
            }

            
            $sqlInsert = "INSERT INTO agendamento (data, hora, id_agenda, id_usuario, id_turma) 
                          VALUES (:data, :hora, :id_agenda, :id_usuario, :id_turma)";
            $insert = $conexao->prepare($sqlInsert);
            $insert->bindParam(":data", $agenda['data']);
            $insert->bindParam(":hora", $agenda['hora']);
            $insert->bindParam(":id_agenda", $agenda['id_agenda'], PDO::PARAM_INT);
            $insert->bindParam(":id_usuario", $agenda['id_usuario'], PDO::PARAM_INT);
            $insert->bindParam(":id_turma", $agenda['id_turma'], PDO::PARAM_INT);

            if ($insert->execute()) {
                $conexao->commit();
                $_SESSION['mensagem'] = [
                    'tipo' => 'success',
                    'texto' => 'Agendamento realizado com sucesso!'
                ];
            } else {
                throw new Exception("Erro ao realizar o agendamento.");
            }

        } catch (Exception $e) {
            $conexao->rollBack();
            $_SESSION['mensagem'] = [
                'tipo' => 'danger',
                'texto' => $e->getMessage()
            ];
        } finally {
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