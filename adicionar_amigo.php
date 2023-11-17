<?php

include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario'];

        $idUsuarioAtual = 1; 

        $sqlVerificarAmizade = "SELECT * FROM amizades WHERE usuario_seguiu = ? AND usuario_seguindo = ?";
        $stmtVerificarAmizade = $conn->prepare($sqlVerificarAmizade);
        $stmtVerificarAmizade->bind_param("ii", $idUsuarioAtual, $id_usuario);
        $stmtVerificarAmizade->execute();
        $resultVerificarAmizade = $stmtVerificarAmizade->get_result();

        if ($resultVerificarAmizade->num_rows === 0) {
            $sqlInserirAmizade = "INSERT INTO amizades (usuario_seguiu, usuario_seguindo) VALUES (?, ?)";
            $stmtInserirAmizade = $conn->prepare($sqlInserirAmizade);
            $stmtInserirAmizade->bind_param("ii", $idUsuarioAtual, $id_usuario);

            if ($stmtInserirAmizade->execute()) {
                echo 'Amigo adicionado com sucesso!';
            } else {
                echo 'Erro ao adicionar amigo. Tente novamente.';
            }
        } else {
            echo 'Você já é amigo desse usuário.';
        }
    } else {
        echo 'ID do usuário não especificado.';
    }
} else {
    echo 'Método de requisição inválido.';
}

$stmtVerificarAmizade->close();
$stmtInserirAmizade->close();
$conn->close();
?>
