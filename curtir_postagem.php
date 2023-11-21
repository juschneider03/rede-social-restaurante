<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    if (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];

        // Verificar se o usuário já curtiu a postagem
        $verificar_curtida = $conn->prepare("SELECT * FROM curtidas WHERE post = ? AND usuario = ?");
        $verificar_curtida->bind_param("ii", $post_id, $id_usuario);
        $verificar_curtida->execute();
        $verificar_result = $verificar_curtida->get_result();

        if ($verificar_result->num_rows > 0) {
            // Se o usuário já curtiu, remover a curtida
            $remover_curtida = $conn->prepare("DELETE FROM curtidas WHERE post = ? AND usuario = ?");
            $remover_curtida->bind_param("ii", $post_id, $id_usuario);
            if ($remover_curtida->execute()) {
                echo "unlike"; // Indica que a curtida foi removida
            } else {
                echo "Erro ao remover a curtida: " . $remover_curtida->error;
            }
            $remover_curtida->close();
        } else {
            // Se o usuário ainda não curtiu, adicionar a curtida
            $adicionar_curtida = $conn->prepare("INSERT INTO curtidas (post, usuario) VALUES (?, ?)");
            $adicionar_curtida->bind_param("ii", $post_id, $id_usuario);
            if ($adicionar_curtida->execute()) {
                echo "like"; // Indica que a curtida foi adicionada
            } else {
                echo "Erro ao adicionar a curtida: " . $adicionar_curtida->error;
            }
            $adicionar_curtida->close();
        }

        $verificar_curtida->close();
    } else {
        echo "ID da postagem não fornecido.";
    }
} else {
    echo "Sessão não iniciada ou ID de usuário inválido.";
}

$conn->close();
?>
