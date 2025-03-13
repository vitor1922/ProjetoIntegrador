<!-- editarCurso.php-->
 
 
<?php
session_start();
$_SESSION['mensagem'] = NULL;
$_SESSION['perfil_mensagem'] = NULL;
 
#inicia as variaveis de sessão
include_once('../../constantes.php');
 
include_once('../../data/conexao.php');
 
 
 
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $curso = filter_input(INPUT_POST, "txtCurso", FILTER_SANITIZE_SPECIAL_CHARS);
    $URL = filter_input(INPUT_POST, "txtURL", FILTER_SANITIZE_SPECIAL_CHARS);
    $cursoId = filter_input(INPUT_POST, "cursoId", FILTER_SANITIZE_SPECIAL_CHARS);
 
    $sqlCurso = "SELECT * FROM curso WHERE id_curso = :id_curso";
    $selectCursos = $conexao->prepare($sqlCurso);
    $selectCursos->bindParam(":id_curso", $cursoId);
    if ($selectCursos->execute()) {
        $cursoSql = $selectCursos->fetch(PDO::FETCH_ASSOC);
    }
   
 
 
 
 
 
   
       
 
        if (isset($_FILES["imgCurso"]) && !empty($_FILES["imgCurso"]["name"])) {
            $allowedTypes = ["image/png", "image/jpeg"];
            $fileType = mime_content_type($_FILES["imgCurso"]["tmp_name"]);
            $ext = strtolower(pathinfo($_FILES["imgCurso"]["name"], PATHINFO_EXTENSION));
 
            if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
 
                $nameFile = pathinfo($_FILES["imgCurso"]["name"], PATHINFO_FILENAME);
                $nameFile = $nameFile . $curso;
                $imagem_url = hash("md5", $nameFile) . "." . $ext;
                $dir = "../../foto/";
                move_uploaded_file($_FILES["imgCurso"]["tmp_name"], $dir . $imagem_url);
            } else {
                die;
                $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $cursoId);
                exit;
            }
        } else {
            $imagem_url = $cursoSql["imagem"];
        }
   
 
    // codigo para o insert
    try {
        if($curso == ""){
            $curso = $cursoSql["nome_do_curso"];
        }
        if($URL == ""){
            $URL = $cursoSql["url"];
        }
 
        $sql = "UPDATE curso SET nome_do_curso=:curso, imagem=:imagem, url=:url WHERE id_curso = :id_curso";
        $insert = $conexao->prepare($sql);
        $insert->bindParam(":curso", $curso);
        $insert->bindParam(":imagem", $imagem_url);
        $insert->bindParam(":url", $URL);
        $insert->bindParam(":id_curso", $cursoId);
 
        if ($insert->execute()) {
            $_SESSION['mensagem'] = "Curso Atualizado com sucesso";
            header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $cursoId);
            exit;
        } else {
            throw new Exception("Erro ao atualizar");
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Ocorreu um erro ao atualizar!" . $e;
        header("Location: " . BASE_URL . "screens/infoCurso.php?id=". $cursoId);
        exit;
    } finally {
        unset($conexao);
    }
}