<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    $query = "SELECT p.*, u.nome FROM postagens p
    INNER JOIN usuario u ON p.usuario = u.id_usuario
    LEFT JOIN amizades a ON p.usuario = a.usuario_seguindo AND a.usuario_seguiu = $id_usuario
    ORDER BY p.id_post DESC";


    $result = $conn->query($query);

    $publicacoes = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $publicacoes[] = $row;
        }
    }

    echo json_encode($publicacoes);
} else {
    echo json_encode(['error' => 'Usuário não autenticado']);
}

$conn->close();
?>
