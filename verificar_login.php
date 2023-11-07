<?php
include("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$query = "SELECT id_usuario FROM usuario WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 1) {
    $stmt->bind_result($id_usuario);
    $stmt->fetch();

    // Iniciar uma sessão e armazenar o ID do usuário nela
    session_start();
    $_SESSION['id_usuario'] = $id_usuario;

    header("Location: Perfil.php");
    exit();
} else {
    echo 'Erro: Credenciais inválidas.';
}

$stmt->close();
$conn->close();
?>