<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

include_once('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['id_curso'])) {
        $idCurso = filter_input(INPUT_POST, "id_curso", FILTER_SANITIZE_NUMBER_INT);
        
        try {
            $sql = "DELETE FROM curso WHERE id_curso = :id_curso";
            $delete = $conexao->prepare($sql);
            $delete->bindParam(":id_curso", $idCurso);
            
            if ($delete->execute()) {
                $_SESSION['mensagem'] = "Curso excluído com sucesso";
                $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                
                // Redireciona para a página gerenciamentoCursos.php após a exclusão com sucesso
                header("Location: " . BASE_URL . "screens/gerenciamentoCursos.php");
                exit;  // Não se esqueça de usar exit após o header para evitar a execução de código adicional
            } else {
                throw new Exception("Erro ao excluir o curso");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao excluir o curso: " . $e->getMessage();
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            
            // Em caso de erro, redireciona para a página gerenciamentoCursos.php
            header("Location: " . BASE_URL . "screens/gerenciamentoCursos.php");
            exit;
        } finally {
            unset($conexao);
        }
    }
}


