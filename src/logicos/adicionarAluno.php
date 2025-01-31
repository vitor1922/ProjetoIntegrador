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
        

        $sqlUsuario = "SELECT * FROM usuario WHERE cpf = :cpf";
        $selectUsuario = $conexao->prepare($sqlUsuario);
        $selectUsuario->bindParam(":cpf", $cpf);
        if ($selectUsuario->execute()) {
            $usuario = $selectUsuario->fetch(PDO::FETCH_ASSOC);
            // o $alunoId retorna o id de usuario e não o id de aluno, o id de aluno é autoincrementado
        }
        if($usuario == false){
            echo("deu ruim");
            header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
            $_SESSION['mensagem'] = "Usuario não existe!";
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            unset($conexao);
            die;
        }else{
            try {
                $sqlInsert = "INSERT INTO alunos ( id_usuario, id_turma) values (:id_usuario, :id_turma)";
                $insert = $conexao->prepare($sqlInsert);
                $insert->bindParam(":id_usuario", $usuario["id_usuario"]);
                $insert->bindParam(":id_turma", $turma);


                $sqlUpdate = "UPDATE usuario SET perfil = 'aluno' WHERE id_usuario = :id_usuario";
                $update = $conexao->prepare($sqlUpdate);
                $update->bindParam(":id_usuario", $usuario["id_usuario"]);

                $sqlVerifica = "SELECT * FROM alunos WHERE id_usuario = :id_usuario AND id_turma = :id_turma";
                $verifica = $conexao->prepare($sqlVerifica);
                $verifica->bindParam(":id_usuario", $usuario["id_usuario"]);
                $verifica->bindParam(":id_turma", $turma);

                if($verifica->execute()){
                    $verificacao = $verifica->fetchAll(PDO::FETCH_ASSOC);
                }
                
                if ($verificacao == false){
                    $update->execute();
                    if ($insert->execute() ) {
                        
                        $_SESSION['mensagem'] = "Aluno adicionado com sucesso";
                        $_SESSION['perfil_mensagem'] = "text-success bg-success-subtle";
                        header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
                        exit;
                    } else {
                        throw new Exception("Erro ao Criar");
                    }

                }else{
                    $_SESSION['mensagem'] = "Aluno já existe";
                    $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
                    header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
                }


                
            } catch (Exception $e) {
                $_SESSION['mensagem'] = "Ocorreu um erro ao criar!" . $e;
                $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
                header("Location: " . BASE_URL . "screens/infoTurma.php?id=" . $turma);
                exit;
            } finally {
                unset($conexao);
            }
        }
        // codigo para o insert
    }
}
