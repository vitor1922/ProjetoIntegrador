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
        $_SESSION['mensagem'] = "Erro: Apenas arquivos JPG ou PNG são permitidos.";
        header("Location: " . BASE_URL . "screens/criarPost.php");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Erro: Nenhuma imagem foi enviada.";
    header("Location: " . BASE_URL . "screens/criarPost.php");
    exit;
}

try {
    // 1. Criar um novo post na tabela 'post' e obter o id gerado
    $titulo = $_POST['txtTituloPost'] ?? null;
    $id_usuario = $_SESSION['id_usuario'] ?? null;

    if (!$titulo || !$id_usuario) {
        throw new Exception("Erro: Dados do post incompletos.");
    }

    $sql = "INSERT INTO post (titulo, id_usuario) VALUES (:titulo, :id_usuario)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":titulo", $titulo);
    $stmt->bindParam(":id_usuario", $id_usuario);
    $stmt->execute();

    // 2. Obter o ID do post recém-criado
    $id_post = $conexao->lastInsertId();

    // 3. Inserir a imagem associada ao post
    $sql = "INSERT INTO img_post (url_img, id_post) VALUES (:url_img, :id_post)";
    $update = $conexao->prepare($sql);
    $update->bindParam(":url_img", $postAluno_url);
    $update->bindParam(":id_post", $id_post);

    if ($update->execute()) {
        $_SESSION['mensagem'] = "Post criado com sucesso!";
        header("Location: " . BASE_URL . "screens/criarPost.php");
        exit;
    } else {
        throw new Exception("Erro ao salvar a imagem do post.");
    }
} catch (Exception $e) {
    $_SESSION['mensagem'] = "Erro: " . $e->getMessage();
    header("Location: " . BASE_URL . "screens/criarPost.php");
    exit;
}

unset($conexao);
?>