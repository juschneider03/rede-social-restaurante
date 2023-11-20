<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario']) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $post_id = $_POST['post_id'];

    // Verifique se o usuário já curtiu esta postagem
    $query = "SELECT * FROM curtidas WHERE post = ? AND usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $post_id, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Se o usuário não curtiu, insira a curtida
        $insert_query = "INSERT INTO curtidas (post, usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $post_id, $id_usuario);
        $stmt->execute();
        echo "success"; // Envie uma resposta de sucesso para o JavaScript
    } else {
        // Se o usuário já curtiu, remova a curtida
        $delete_query = "DELETE FROM curtidas WHERE post = ? AND usuario = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("ii", $post_id, $id_usuario);
        $stmt->execute();
        echo "success"; // Envie uma resposta de sucesso para o JavaScript
    }
} else {
    echo "error"; // Envie uma resposta de erro para o JavaScript
}
?>
