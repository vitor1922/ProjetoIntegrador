<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
        $idAgenda = filter_input(INPUT_POST, "idHorario", FILTER_SANITIZE_SPECIAL_CHARS);
        $idCurso = filter_input(INPUT_POST, "idCurso", FILTER_SANITIZE_SPECIAL_CHARS);
        
        try {
            $sql = "DELETE FROM agenda WHERE id_agenda = :id_agenda";
            $delete = $conexao->prepare($sql);
            $delete->bindParam(":id_agenda", $idAgenda);
           

            if ($delete->execute()) {
                $_SESSION['mensagem'] = "aluno excluido com sucesso";
                $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $idCurso);
                exit;
            } else {
                throw new Exception("Erro ao Criar");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao Excluir!" . $e;
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $idCurso);
            exit;
        } finally {
            unset($conexao);
        }
}