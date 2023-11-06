<?php
    include("conexao.php");

    $id_usuario = 1; 

    $query = "SELECT p.* FROM publicacoes p
              INNER JOIN amizade a ON p.autor_id = a.id_seguido
              WHERE a.id_seguiu = $id_usuario
              ORDER BY p.id DESC";

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