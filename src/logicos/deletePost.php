<?php
session_start();
include('../../constantes.php');
include_once('../../data/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $id_post = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id_post) {
        try {
            // Primeiro, busca a imagem associada ao post
            $sql = "SELECT url_img FROM img_post WHERE id_post = :id_post";
            $select = $conexao->prepare($sql);
            $select->bindParam(':id_post', $id_post, PDO::PARAM_INT);
            $select->execute();
            $post = $select->fetch(PDO::FETCH_ASSOC);

            if ($post && !empty($post['url_img'])) {
                $url_img = $post['url_img'];
                $dirPost = "../../postAluno/";
                $filePath = $dirPost . $url_img;

                // Se a imagem existir, exclui do servidor
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Deleta primeiro a imagem do banco
            $sql = "DELETE FROM img_post WHERE id_post = :id_post";
            $delete = $conexao->prepare($sql);
            $delete->bindParam(':id_post', $id_post, PDO::PARAM_INT);
            $delete->execute();

            // Agora, deleta o post
            $sql = "DELETE FROM post WHERE id_post = :id_post";
            $delete = $conexao->prepare($sql);
            $delete->bindParam(':id_post', $id_post, PDO::PARAM_INT);
            $delete->execute();

            $_SESSION['mensagem'] = "Postagem excluída com sucesso!";
        } catch (Exception $e) {
            $_SESSION['mensagem'] = "Erro ao excluir a postagem: " . $e->getMessage();
        } finally {
            // Redireciona para a página de perfil após a exclusão
            header("Location: " . BASE_URL . "screens/perfildoAluno.php");
            unset($conexao);
            exit;
        }
    } else {
        $_SESSION['mensagem'] = "ID de postagem inválido.";
        header("Location: " . BASE_URL . "screens/perfildoAluno.php");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Requisição inválida.";
    header("Location: " . BASE_URL . "screens/perfildoAluno.php");
    exit;
}
