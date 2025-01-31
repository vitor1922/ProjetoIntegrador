<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtAluno'])) {
        $idAluno = filter_input(INPUT_POST, "txtAluno", FILTER_SANITIZE_SPECIAL_CHARS);
        $turmaId = filter_input(INPUT_POST, "txtIdTurma", FILTER_SANITIZE_SPECIAL_CHARS);
    

        


        // codigo para o insert
        try {
            $sql = "DELETE FROM alunos WHERE id_aluno = :id_aluno";
            $delete = $conexao->prepare($sql);
            $delete->bindParam(":id_aluno", $idAluno);
           

            if ($delete->execute()) {
                $_SESSION['mensagem'] = "aluno excluido com sucesso";
                $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                header("Location: " . BASE_URL . "screens/infoTurma.php?id=". $turmaId);
                exit;
            } else {
                throw new Exception("Erro ao Criar");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao Excluir!" . $e;
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            header("Location: " . BASE_URL . "screens/infoTurma.php?id=". $turmaId);
            exit;
        } finally {
            unset($conexao);
        }
    }
}