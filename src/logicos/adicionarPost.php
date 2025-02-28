<?php

#inicia as variaveis de sessão
include('../constantes.php');
include_once('../data/conexao.php');

session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nomeUser = $_SESSION['nome'] ?? "";
$idUser = $_SESSION['id_usuario'] ?? "";
$perfil = $_SESSION['perfil'];
$login = NULL;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtTituloPost']) && !empty($_POST["txtConteudoPost"])) {
        $postagemId = filter_input(INPUT_POST, "txtPostId", FILTER_SANITIZE_SPECIAL_CHARS);
        $tituloPost = filter_input(INPUT_POST, "txtTituloPost", FILTER_SANITIZE_SPECIAL_CHARS);
        $conteudoPost = filter_input(INPUT_POST, "txtConteudoPost", FILTER_SANITIZE_SPECIAL_CHARS);
        $imgName = filter_input(INPUT_POST, "imgName", FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset($_FILES["imgPosts"]) && !empty($_FILES["imgPosts"]["name"])) {
            $allowedTypes = ["image/png", "image/jpeg", "image/jpg"];
            $fileType = mime_content_type($_FILES["imgPosts"]["tmp_name"]);
            $ext = strtolower(pathinfo($_FILES["imgPosts"]["name"], PATHINFO_EXTENSION));

            if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
                $nameFile = pathinfo($_FILES["imgPost"]["name"], PATHINFO_FILENAME);
                $imagem_url = hash("md5", $nameFile) . "." . $ext;
                $dir = "../imgPosts/";
                move_uploaded_file($_FILES["imgPosts"]["tmp_name"], $dir . $imagem_url);
            } else {
                $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                header("Location: " . BASE_URL . "screens/UpdatePost.php");
                exit;
            }
        } else {

            $imagem_url = $imgName;
        }

        try {
            $sql = "UPDATE postagens SET titulo=:titulo, conteudo=:conteudo, imagem_url=:imgName WHERE postagem_id = :postagemId";
            $update = $conexao->prepare($sql);
            $update->bindParam(':titulo', $tituloPost);
            $update->bindParam(':conteudo', $conteudoPost);
            $update->bindParam(':imgName', $imagem_url);
            $update->bindParam(':postagemId', $postagemId);

            if ($update->execute()) {
                $_SESSION["mensagem"] = "Atualizado com sucesso!";
                header("Location: " . BASE_URL . "screens/postar.php");
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao atualizar");
            }
        } catch (Exception $e) {
            $_SESSION["mensagem"] = "ocorreu um erro ao atualizar!" . $e;
            header("Location: " . BASE_URL . "screens/adicionarPost.php");
            exit;
        } finally {
            unset($conexao);
        }
    }
}
