<?php
include("conexao.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $_POST['textarea'];
    $foto = $_FILES["foto"]["tmp_name"];
    
    $query = "";
    $foto_base64 = "";
    
    if ($foto) {
        $foto_base64 = base64_encode(file_get_contents($foto));
        $query = "INSERT INTO postagens (usuario, comentario, foto, data_post) VALUES (?, ?, ?, NOW())";
    } else {
        $query = "INSERT INTO postagens (usuario, comentario, data_post) VALUES (?, ?, NOW())";
    }
    
    $stmt = $conn->prepare($query);
    
    if ($foto) {
        $stmt->bind_param("iss", $id_usuario, $comentario, $foto_base64);
    } else {
        $stmt->bind_param("is", $id_usuario, $comentario);
    }
    
    if ($stmt->execute()) {
        echo "Publicação salva com sucesso!";
    } else {
        echo "Erro ao salvar a publicação: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo 'error: Método inválido';
}

$conn->close();
?>
