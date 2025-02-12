<?php
session_start();
include_once('../../data/conexao.php');
include('../../constantes.php');

// var_dump($_FILES["banner"]);
// die;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = filter_input(INPUT_POST, "txtUserId", FILTER_SANITIZE_SPECIAL_CHARS);
    $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
    $biografia = filter_input(INPUT_POST, "txtBiografia", FILTER_SANITIZE_SPECIAL_CHARS);
    $imgName = filter_input(INPUT_POST, "imgName", FILTER_SANITIZE_SPECIAL_CHARS);
    $imgBanner = filter_input(INPUT_POST, "imgBanner", FILTER_SANITIZE_SPECIAL_CHARS);

    if (isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"])) {
        $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
        $fileType = mime_content_type($_FILES["foto"]["tmp_name"]);
        $ext = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
        if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
            $nameFile = pathinfo($_FILES["foto"]["name"], PATHINFO_FILENAME);
            $imagem_url = hash("md5", $nameFile) . "." . $ext;
            $dir = "../../foto/";

            move_uploaded_file($_FILES["foto"]["tmp_name"], $dir . $imagem_url);
        } else {
            $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
            header("Location: " . BASE_URL . "screens/perfil.php");
            exit;
        }
    } else {
        $imagem_url = $imgName;
    }






    if (isset($_FILES["banner"]) && !empty($_FILES["banner"]["name"])) {
        $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
        $fileType = mime_content_type($_FILES["banner"]["tmp_name"]);
        $ext = strtolower(pathinfo($_FILES["banner"]["name"], PATHINFO_EXTENSION));
        if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
            $nameFile = pathinfo($_FILES["banner"]["name"], PATHINFO_FILENAME);
            $banner_url = hash("md5", $nameFile) . "." . $ext;
            $dirBanner = "../../bannerP/";

            move_uploaded_file($_FILES["banner"]["tmp_name"], $dirBanner . $banner_url);
        } else {
            $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
            header("Location: " . BASE_URL . "screens/perfil.php");
            exit;
        }
    } else {
        $banner_url = $imgBanner;
    }


    try {
        $sql = "UPDATE usuario SET nome = :nome, biografia = :biografia, foto = :foto, banner = :banner WHERE id_usuario = :id_usuario";
        $update = $conexao->prepare($sql);
        $update->bindParam(":id_usuario", $id_usuario);
        $update->bindParam(":nome", $nome);
        $update->bindParam(":biografia", $biografia);
        $update->bindParam(":foto", $imagem_url);
        $update->bindParam(":banner", $banner_url);

        if ($update->execute()) {
            $_SESSION['mensagem'] = "Perfil atualizado com sucesso.";
            header("Location: " . BASE_URL . "screens/perfil.php");
            exit;
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar o perfil.";
        }
    } catch (Exception $e) {
        $_SESSION['mensagem'] = "Erro: " . $e->getMessage();
        header("Location: " . BASE_URL . "screens/perfil.php");
        exit;
    }
    unset($conexao);
}


