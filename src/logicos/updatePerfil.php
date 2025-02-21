<?php
session_start();
include_once('../../data/conexao.php');
include('../../constantes.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION['id_usuario'] ?? NULL;
    if (!$id_usuario) {
        header("Location: " . BASE_URL . "screens/signUp.php");
        exit;
    }

    $nome = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
    $biografia = filter_input(INPUT_POST, "txtBiografia", FILTER_SANITIZE_SPECIAL_CHARS);
    $imgName = $_POST["imgName"] ?? "";
    $imgBanner = $_POST["imgBanner"] ?? "";

    function uploadImagem($file, $path) {
        $allowedTypes = ["image/png", "image/jpg", "image/jpeg"];
        if ($file && $file["error"] === 0) {
            $fileType = mime_content_type($file["tmp_name"]);
            $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
            if (in_array($fileType, $allowedTypes) && in_array($ext, ["jpg", "jpeg", "png"])) {
                $nomeArquivo = uniqid() . "." . $ext;
                move_uploaded_file($file["tmp_name"], $path . $nomeArquivo);
                return $nomeArquivo;
            }
        }
        return NULL;
    }

    $imagem_url = uploadImagem($_FILES["foto"] ?? NULL, "../../foto/") ?? $imgName;
    $banner_url = uploadImagem($_FILES["banner"] ?? NULL, "../../bannerP/") ?? $imgBanner;

    $sql = "UPDATE usuario SET nome = ?, biografia = ?, foto = ?, banner = ? WHERE id_usuario = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$nome, $biografia, $imagem_url, $banner_url, $id_usuario]);

    $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
    header("Location: " . BASE_URL . "screens/Perfil.php");
    exit;
}
?>
