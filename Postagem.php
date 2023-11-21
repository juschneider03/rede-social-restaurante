<?php
    include("conexao.php");
    session_start();
    
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);

        $comentario = $_POST['textarea'];
    
        if ($_FILES['post_imagem']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['post_imagem']['tmp_name']);
        } else {
            $foto = null; 
        }
    
        $stmt = $conn->prepare("INSERT INTO postagens (usuario, comentario, foto) VALUES (?,$comentario, $foto)");
        $stmt->bind_param("iss", $usuario_id, $comentario, $foto);
    
        $stmt->close();
        $conn->close();

    } else {
        echo "Sessão não iniciada ou ID de usuário inválido.";
    }
        $sql = "SELECT p.*, u.nome FROM postagens p
        JOIN usuario u ON p.usuario = u.id_usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="post">';
        echo '<div class="infoUserPost">';
        echo '<div class="imgUserPost"></div>';
        echo '<div class="nameAndHour">';
        echo '<strong>' . $row['nome'] . '</strong>';
        echo '<p>' . $row['data_postagem'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<p>' . $row['comentario'] . '</p>';
        echo '</div>';
    }
} else {
    echo "Nenhuma postagem encontrada.";
}
?>