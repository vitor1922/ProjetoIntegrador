<?php

#inicia as variaveis de sessão
include('../../constantes.php');
include_once('../../data/conexao.php');

session_start();
$mensagem = $_SESSION['mensagem'] ?? NULL;
$_SESSION['mensagem'] = NULL;
$_SESSION["perfil_mensagem"] = NULL;

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



        try {
            
            $sqlPost = "INSERT INTO post (titulo, texto, localizador, data_criacao, id_usuario) VALUES (:titulo, :texto, :localizador, :data_criacao, :id_usuario) ";
            $post = $conexao->prepare($sqlPost);
            $post->bindParam(':titulo', $postTitulo);
            $post->bindParam(':texto', $postTexto);
            $post->bindParam(':localizador', $localizador);
            $post->bindParam(':data_criacao', $data);
            $post->bindParam(":id_usuario", $idUsuario);
            $post->execute();
            
            $sqlPostagem = "SELECT * FROM post WHERE localizador = :localizador";
            $selectPostagem = $conexao->prepare("$sqlPostagem");
            $selectPostagem->bindParam(":localizador", $localizador);
            if ($selectPostagem->execute()) {
                $postagem = $selectPostagem->fetch(PDO::FETCH_ASSOC);
            }
            $postId = $postagem["id_post"];
            
            
            $imagens = $_FILES["imgsPost"];
            if (true ) {
                
                for($cont = 0; $cont < count($imagens["name"]); $cont++ ){
                    echo($cont);
                    $allowedTypes = ["image/png", "image/jpeg"];
                    $fileType = mime_content_type($imagens["tmp_name"][$cont]);
                    $ext = strtolower(pathinfo($imagens["name"][$cont], PATHINFO_EXTENSION));

                    if (in_array($fileType, $allowedTypes) && ($ext == "jpg" || $ext == "jpeg" || $ext == "png")) {
                        $nameFile = pathinfo($imagens["name"][$cont], PATHINFO_FILENAME);
                        $imagem_url = hash("md5", $nameFile) . "." . $ext;
                        $dir = "../../postAluno/";
                        move_uploaded_file($imagens["tmp_name"][$cont], $dir . $imagem_url);
                    } else {
                        $_SESSION['mensagem'] =  "Erro: Apenas arquivos JPG ou PNG são permitidos.";
                        $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
                        header("Location: " . BASE_URL . "screens/blog.php");
                        exit;
                    }

                    $sqlImg = "INSERT INTO img_post (id_post, url_img) values (:id_post, :url_img)";
                    $insertImg = $conexao->prepare($sqlImg);
                    $insertImg->bindParam(":id_post", $postId);
                    $insertImg->bindParam(":url_img", $imagem_url);
                    $insertImg->execute();
                }
              
                header("Location: " . BASE_URL . "screens/blog.php");
                exit;
            } else {
                throw new Exception("Ocorreu um erro ao adicionar as imagem");
            }
        } catch (Exception $e) {
            $_SESSION["mensagem"] = "ocorreu um erro ao adicionar o post!" . $e;
            $_SESSION['perfil_mensagem'] = "text-danger bg-danger-subtle";
            header("Location: " . BASE_URL . "screens/blog.php");
            exit;
        } finally {
            unset($conexao);
        }
    }
}
