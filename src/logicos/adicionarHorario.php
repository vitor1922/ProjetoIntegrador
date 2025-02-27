<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtCurso']) && !empty($_POST["txtHorario"]) && !empty($_POST["txtData"]) && !empty($_POST["txtVagas"])) {
        $curso = filter_input(INPUT_POST, "txtCurso", FILTER_SANITIZE_SPECIAL_CHARS);
        $turma = filter_input(INPUT_POST, "txtTurma", FILTER_SANITIZE_SPECIAL_CHARS);
        $hora = filter_input(INPUT_POST, "txtHorario", FILTER_SANITIZE_SPECIAL_CHARS);
        $data = filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_SPECIAL_CHARS);
        $vagas = filter_input(INPUT_POST, "txtVagas", FILTER_SANITIZE_SPECIAL_CHARS);
        $usuario = $_SESSION["id_usuario"];

        


        // codigo para o insert
        try {
            $sql = "INSERT INTO agenda (data, hora, vagas, id_curso, id_usuario, id_turma) values (:data, :hora, :vagas, :curso, :usuario, :id_turma)";
            $insert = $conexao->prepare($sql);
            $insert->bindParam(":data", $data);
            $insert->bindParam(":hora", $hora);
            $insert->bindParam(":vagas", $vagas);
            $insert->bindParam(":curso", $curso);
            $insert->bindParam(":usuario", $usuario);
            $insert->bindParam(":id_turma", $turma);

            if ($insert->execute()) {
                
                $_SESSION['mensagem'] = "Horário adicionado";
                header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $curso);
                exit;
            } else {
                throw new Exception("Erro ao Criar");
            }
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Ocorreu um erro ao criar!" . $e;
            header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $curso);
            exit;
        } finally {
            unset($conexao);
        }
    }
}
