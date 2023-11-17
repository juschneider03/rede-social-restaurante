<?php
include("conexao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $_POST['textarea']; 

    echo $comentario;

    $query = "INSERT INTO postagens (usuario, comentario, data_post) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $id_usuario, $comentario);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error: ';
    }

    $stmt->close();
} else {
    echo 'error: Método inválido';
}

$conn->close();
?>
