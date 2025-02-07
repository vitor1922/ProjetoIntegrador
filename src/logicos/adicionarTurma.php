<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;
$idUsuario = $_SESSION['id_usuario'];

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {


    $idCurso = filter_input(INPUT_POST, "txtIdCurso", FILTER_SANITIZE_SPECIAL_CHARS);
    $idTurma = filter_input(INPUT_POST, "txtIdTurma", FILTER_SANITIZE_SPECIAL_CHARS);
    $dataInicio = filter_input(INPUT_POST, "txtDataInicio", FILTER_SANITIZE_SPECIAL_CHARS);
    $dataFim = filter_input(INPUT_POST, "txtDataFim", FILTER_SANITIZE_SPECIAL_CHARS);
    $professor = filter_input(INPUT_POST, "txtProfessor", FILTER_SANITIZE_SPECIAL_CHARS);


    $sqlTurma = "SELECT * FROM turma WHERE numero_da_turma = :id_turma";
    $selectTurma = $conexao->prepare("$sqlTurma");
    $selectTurma->bindParam(":id_turma", $idTurma);
    if ($selectTurma->execute()) {
        $turma = $selectTurma->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // codigo para o insert
    try {
        $sql = "INSERT INTO turma (numero_da_turma, data_inicio, data_final, id_curso, id_usuario) values (:numero_da_turma, :data_inicio, :data_final, :id_curso, :id_usuario)";
        $insert = $conexao->prepare($sql);
        $insert->bindParam(":numero_da_turma", $idTurma);
        $insert->bindParam(":data_inicio", $dataInicio);
        $insert->bindParam(":data_final", $dataFim);
        $insert->bindParam(":id_curso", $idCurso);
        $insert->bindParam(":id_usuario", $professor);

        if ($turma == false){
            if ($insert->execute()) {
                $_SESSION['mensagem'] = "Turma Criada com sucesso";
                header("Location: " . BASE_URL . "screens/infoCurso.php?id=" . $idCurso);
                exit;
            } else {
                throw new Exception("Erro ao Criar");
            }
        }else{
            $_SESSION['mensagem'] = "já existe turma com esse codigo";
            header("Location: " . BASE_URL . "screens/infoCurso.php?id=" . $idCurso);
            exit;
        }

        
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao criar!" . $e;
        header("Location: " . BASE_URL . "screens/infoCurso.php?id=" . $idCurso);
        exit;
    } finally {
        unset($conexao);
    }
}
