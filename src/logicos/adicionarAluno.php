<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtCpf']) && !empty($_POST["txtIdTurma"])) {
        $cpf = filter_input(INPUT_POST, "txtCpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $turma = filter_input(INPUT_POST, "txtIdTurma", FILTER_SANITIZE_SPECIAL_CHARS);
        var_dump($turma);
        

        $sqlAlunoId = "SELECT id_usuario FROM usuario WHERE cpf = :cpf";
        $selectAlunoId = $conexao->prepare($sqlAlunoId);
        $selectAlunoId->bindParam(":cpf", $cpf);
        if ($selectAlunoId->execute()) {
            $alunoId = $selectAlunoId->fetch(PDO::FETCH_ASSOC);
        }
        if($alunoId == false){
            echo("deu ruim");
            header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
            $_SESSION['mensagem'] = "Usuario não existe!";
            die;
        }else{
            try {
                $sql = "INSERT INTO alunos (id_aluno, id_usuario, id_turma) values (:data, :hora, :vagas, :curso, :usuario)";
                $insert = $conexao->prepare($sql);
                $insert->bindParam(":data", $data);
                $insert->bindParam(":hora", $hora);
                $insert->bindParam(":vagas", $vagas);
                $insert->bindParam(":curso", $curso);
                $insert->bindParam(":usuario", $usuario);
    
                if ($insert->execute()) {
                    $_SESSION['mensagem'] = "Horário adicionado";
                    header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
                    exit;
                } else {
                    throw new Exception("Erro ao Criar");
                }
            } catch (Exception $e) {
                $_SESSION['mensagem'] = "Ocorreu um erro ao criar!" . $e;
                header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
                exit;
            } finally {
                unset($conexao);
            }
        }
        // codigo para o insert
    }
}
