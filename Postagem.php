<?php
    include("conexao.php");

    $usuario_id = 1; 

    $comentario = $_POST['textarea'];

    if ($_FILES['post_imagem']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['post_imagem']['tmp_name']);
    } else {
        $foto = null; // Caso nenhuma imagem seja enviada
    }

    $stmt = $conn->prepare("INSERT INTO postagens (usuario, comentario, foto) VALUES (?,$comentario, $foto)");
    $stmt->bind_param("iss", $usuario_id, $comentario, $foto);

    $stmt->close();
    $conn->close();
?>