<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario']) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $post_id = $_POST['post_id'];

    $query = "SELECT * FROM curtidas WHERE post = ? AND usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $post_id, $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $insert_query = "INSERT INTO curtidas (post, usuario) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $post_id, $id_usuario);
        $stmt->execute();
        echo "success"; 
    } else {
        $delete_query = "DELETE FROM curtidas WHERE post = ? AND usuario = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("ii", $post_id, $id_usuario);
        $stmt->execute();
        echo "success"; 
    }
} else {
    echo "error";
}
?>
