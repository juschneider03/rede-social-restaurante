<?php
    
    include("conexao.php");
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        // Consulta para obter os dados do usuário
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
            $post_id = $_POST['post_id'];

            // Verifique se o usuário já curtiu esta postagem
            $query = "SELECT * FROM curtidas WHERE id_postagem = $post_id AND id_usuario = $id_usuario";
            $result = $conn->query($query);

            if ($result->num_rows === 0) {
                $insert_query = "INSERT INTO curtidas (id_postagem, id_usuario) VALUES ($post_id, $id_usuario)";
                $conn->query($insert_query);
            } else {
                $delete_query = "DELETE FROM curtidas WHERE id_postagem = $post_id AND id_usuario = $id_usuario";
                $conn->query($delete_query);
            }

            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }
?>
