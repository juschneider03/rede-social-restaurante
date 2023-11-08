<?php
    
    include("conexao.php");
    
    $user_id = 1; // Substitua pelo ID do usuário logado

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Verifique se o usuário já curtiu esta postagem
        $query = "SELECT * FROM curtidas WHERE id_postagem = $post_id AND id_usuario = $user_id";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            $insert_query = "INSERT INTO curtidas (id_postagem, id_usuario) VALUES ($post_id, $user_id)";
            $conn->query($insert_query);
        } else {
            $delete_query = "DELETE FROM curtidas WHERE id_postagem = $post_id AND id_usuario = $user_id";
            $conn->query($delete_query);
        }

        header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>
