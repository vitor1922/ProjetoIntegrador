<?php
session_start();
include_once('../../data/conexao.php');
include('../../constantes.php');


if (isset($_FILES["postAluno"]) && !empty($_FILES["postAluno"]["name"])) {
    $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
    $fileType = mime_content_type($_FILES["postAluno"]["tmp_name"]);
    $ext = strtolower(pathinfo($_FILES["postAluno"]["name"], PATHINFO_EXTENSION));
    if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
        $nameFile = pathinfo($_FILES["postAluno"]["name"], PATHINFO_FILENAME);
        $postAluno_url = hash("md5", $nameFile) . "." . $ext;
        $dirPost = "../../postAluno/";

        move_uploaded_file($_FILES["postAluno"]["tmp_name"], $dirPost . $postAluno_url);
    } else {
        $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
        header("Location: " . BASE_URL . "screens/criarPost.php");
        exit;
    }
} else {
    $postAluno_url = $imgPost;
}

try {
    $sql = "INSERT INTO img_post (url_img, id_post) VALUES :url_img = url_img, :url_post = url_post ";
    $update = $conexao->prepare($sql);
    $update->bindParam(":url_img", $url_img);
    $update->bindParam(":id_post", $id_post);

    if ($update->execute()) {
        $_SESSION['mensagem'] = "Perfil atualizado com sucesso.";
        header("Location: " . BASE_URL . "screens/criarPost.php");
        exit;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar o perfil.";
    }
} catch (Exception $e) {
    $_SESSION['mensagem'] = "Erro: " . $e->getMessage();
    header("Location: " . BASE_URL . "screens/criarPost.php");
    exit;
}
unset($conexao);
