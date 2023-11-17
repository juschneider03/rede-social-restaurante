<?php
    include("conexao.php");

    $id_usuario = 1; 

    $query = "SELECT * FROM postagens WHERE usuario = ?";
    $result = $conn->query($query);

    $publicacoes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $publicacoes[] = $row;
        }
    }

    echo json_encode($publicacoes);

    $conn->close();
?>