<?php

#inicia as variaveis de sessão
include('../../constantes.php');
include_once('../../data/conexao.php');

session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;

$logado =  $_SESSION['logado'] ?? FALSE;
$nomeUser = $_SESSION['nome'] ?? "";
$idUser = $_SESSION['id_usuario'] ?? "";
$perfil = $_SESSION['perfil'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['txtTitulo']) && !empty($_POST["txtTexto"])) {
        $postTitulo = filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_SPECIAL_CHARS);
        $postTexto = filter_input(INPUT_POST, "txtTexto", FILTER_SANITIZE_SPECIAL_CHARS);
        $idUsuario = filter_input(INPUT_POST, "txtUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
        $localizador = hash("md5", $postTitulo);
        $data = filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_SPECIAL_CHARS);


        if (isset($_FILES["imgPosts"]) && !empty($_FILES["imgPosts"]["name"])) {
            foreach ($_FILES["imgPosts"] as $imagem) {
                $allowedTypes = ["image/png", "image/jpeg"];
                $fileType = mime_content_type($imagem["tmp_name"]);
                $ext = strtolower(pathinfo($imagem["name"], PATHINFO_EXTENSION));

                if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
                    $nameFile = pathinfo($imagem["name"], PATHINFO_FILENAME);
                    $imagem_url = hash("md5", $nameFile) . "." . $ext;
                    $dir = "../postAluno/";
                    move_uploaded_file($imagem["tmp_name"], $dir . $imagem_url);
                } else {
                    $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                    header("Location: " . BASE_URL . "screens/blog.php");
                    exit;
                }

                $sqlImg = "INSERT INTO img_post (data, hora, vagas, id_curso, id_usuario, id_turma) values (:data, :hora, :vagas, :curso, :usuario, :id_turma)";
                $insertImg = $conexao->prepare($sql);
                $insertImg->bindParam(":data", $data);
                $insertImg->bindParam(":hora", $hora);
                $insertImg->bindParam(":vagas", $vagas);
                $insertImg->bindParam(":curso", $curso);
                $insertImg->bindParam(":usuario", $usuario);
                $insertImg->bindParam(":id_turma", $turma);

                $insert->execute();
            }
        } else {

            $imagem_url = $imgName;
        }

        try {
            $sql = "INSERT INTO post (titulo, texto, localizador, data_criacao) VALUES (:titulo, :texto, :localizador, :data_criacao) ";
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
