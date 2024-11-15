<?php 
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;

#inicia as variaveis de sessão
include_once('../../constantes.php');

include_once('../../data/conexao.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (!empty($_POST['txtCurso']) && !empty($_POST["txtURL"]) && !empty($_FILES["imgCurso"])) {
        $curso = filter_input(INPUT_POST, "txtCurso", FILTER_SANITIZE_SPECIAL_CHARS);
        $URL = filter_input(INPUT_POST, "txtURL", FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($_FILES["imgCurso"]) && !empty($_FILES["imgCurso"]["name"])) {
            $allowedTypes = ["image/png", "image/jpeg"];
            $fileType = mime_content_type($_FILES["imgCurso"]["tmp_name"]);
            $ext = strtolower(pathinfo($_FILES["imgCurso"]["name"], PATHINFO_EXTENSION));

            if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
                
                $nameFile = pathinfo($_FILES["imgCurso"]["name"], PATHINFO_FILENAME);
                $nameFile = $nameFile.$curso;
                $imagem_url = hash("md5", $nameFile) . "." . $ext;
                $dir = "../../foto/";
                move_uploaded_file($_FILES["imgCurso"]["tmp_name"], $dir . $imagem_url);
            } else {
                die;
                $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                header("Location: " . BASE_URL . "screens/gerenciamentoCursos.php");
                exit;
            }
        } else {
            $imagem_url = "";
        }
    }

    // codigo para o insert
    try {
        $sql = "INSERT INTO curso (nome_do_curso, imagem, url) values (:curso, :imagem, :url)";
        $insert=$conexao->prepare($sql);
        $insert->bindParam(":curso", $curso);
        $insert->bindParam(":imagem", $imagem_url);
        $insert->bindParam(":url", $URL);

        if ($insert->execute()){
            $_SESSION['mensagem'] = "Post criado";
            header("Location: " . BASE_URL . "screens/gerenciamentoCursos.php");
            exit;
        } else {
            throw new Exception("Erro ao Criar");
        }

    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao criar!" . $e;
        header("Location: " . BASE_URL . "screens/gerenciamentoCursos.php");
        exit;
    } finally {
        unset($conexao);
    }
}








?>