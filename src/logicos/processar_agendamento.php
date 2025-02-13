<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

# Inicia as variáveis de sessão e inclui constantes e conexão
include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Verifica se os campos necessários foram enviados
    if (!empty($_POST['id_agenda']) && !empty($_POST['id_usuario']) && !empty($_POST['id_aluno'])) {
        // Filtra e sanitiza os dados de entrada
        $idAgenda = filter_input(INPUT_POST, "id_agenda", FILTER_SANITIZE_NUMBER_INT);
        $idUsuario = filter_input(INPUT_POST, "id_usuario", FILTER_SANITIZE_NUMBER_INT);
        $idAluno = filter_input(INPUT_POST, "id_aluno", FILTER_SANITIZE_NUMBER_INT);

        try {
            // Busca a data e a hora da tabela `agenda`
            $sqlBuscaAgenda = "SELECT data, hora FROM agenda WHERE id_agenda = :id_agenda";
            $stmtBuscaAgenda = $conexao->prepare($sqlBuscaAgenda);
            $stmtBuscaAgenda->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
            $stmtBuscaAgenda->execute();

            $agenda = $stmtBuscaAgenda->fetch(PDO::FETCH_ASSOC);

            if ($agenda) {
                $dataAgenda = $agenda['data']; // Data da tabela `agenda`
                $horaAgenda = $agenda['hora']; // Hora da tabela `agenda`

                // Define valores padrão para campos adicionais
                $status = 'pendente';  // Status inicial
                $idTurma = 5;          // Substitua pelo ID da turma (se aplicável)

                // Verifica se o agendamento já existe na tabela `agendamento`
                $sqlVerifica = "SELECT * FROM agendamento WHERE id_agenda = :id_agenda AND id_usuario = :id_usuario AND id_aluno = :id_aluno";
                $verifica = $conexao->prepare($sqlVerifica);
                $verifica->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);
                $verifica->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
                $verifica->bindParam(":id_aluno", $idAluno, PDO::PARAM_INT);
                $verifica->execute();

                $verificacao = $verifica->fetchAll(PDO::FETCH_ASSOC);

                if (empty($verificacao)) {
                    // Insere os dados na tabela `agendamento`
                    $sqlInsert = "INSERT INTO agendamento (data, hora, status, id_usuario, id_turma, id_aluno, id_agenda) 
                                  VALUES (:data, :hora, :status, :id_usuario, :id_turma, :id_aluno, :id_agenda)";
                    $insert = $conexao->prepare($sqlInsert);
                    $insert->bindParam(":data", $dataAgenda);
                    $insert->bindParam(":hora", $horaAgenda);
                    $insert->bindParam(":status", $status);
                    $insert->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
                    $insert->bindParam(":id_turma", $idTurma, PDO::PARAM_INT);
                    $insert->bindParam(":id_aluno", $idAluno, PDO::PARAM_INT);
                    $insert->bindParam(":id_agenda", $idAgenda, PDO::PARAM_INT);

                    if ($insert->execute()) {
                        $_SESSION['mensagem'] = "Agendamento realizado com sucesso!";
                        $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                    } else {
                        throw new Exception("Erro ao realizar o agendamento.");
                    }
                } else {
                    $_SESSION['mensagem'] = "Este agendamento já foi realizado.";
                    $_SESSION['perfil_mensagem'] = "text-warning bg-warning-subtle";
                }
            } else {
                throw new Exception("Agenda não encontrada.");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro: " . $e->getMessage();
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
        } finally {
            // Redireciona de volta para a página de origem
            header("Location: " . BASE_URL . "screens/agendamento.php?id=" . $idAgenda);
            exit;
        }
    } else {
        $_SESSION['mensagem'] = "Todos os campos são obrigatórios!";
        $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
        header("Location: " . BASE_URL . "screens/agendamento.php");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Método de requisição inválido.";
    $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
    header("Location: " . BASE_URL . "screens/agendamento.php");
    exit;
}
?>