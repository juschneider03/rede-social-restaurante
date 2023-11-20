<?php
session_start();
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario'];

        // Valide e sanitize o ID do usuário
        $id_usuario = filter_var($id_usuario, FILTER_VALIDATE_INT);
        if ($id_usuario === false) {
            echo 'ID do usuário inválido.';
            exit();
        }

        if(isset($_SESSION['id_usuario'])){
            $idUsuarioAtual =  $_SESSION['id_usuario'];

            // Verifique se o ID do usuário atual é válido
            $idUsuarioAtual = filter_var($idUsuarioAtual, FILTER_VALIDATE_INT);
            if ($idUsuarioAtual === false) {
                echo 'ID do usuário atual inválido.';
                exit();
            }

            // Verifique se a amizade já existe
            $sqlVerificarAmizade = "SELECT * FROM amizades WHERE (usuario_seguiu = ? AND usuario_seguindo = ?)";
            $stmtVerificarAmizade = $conn->prepare($sqlVerificarAmizade);
            $stmtVerificarAmizade->bind_param("ii", $idUsuarioAtual, $id_usuario);
            $stmtVerificarAmizade->execute();
            $resultVerificarAmizade = $stmtVerificarAmizade->get_result();

            if ($resultVerificarAmizade->num_rows === 0) {
                // A amizade não existe, então podemos adicioná-la
                $sqlInserirAmizade = "INSERT INTO amizades (usuario_seguiu, usuario_seguindo) VALUES (?, ?)";
                $stmtInserirAmizade = $conn->prepare($sqlInserirAmizade);
                $stmtInserirAmizade->bind_param("ii", $idUsuarioAtual, $id_usuario);

                if ($stmtInserirAmizade->execute()) {
                    echo 'Amigo adicionado com sucesso!';
                } else {
                    echo 'Erro ao adicionar amigo. Tente novamente.';
                    // Log de erro: echo $stmtInserirAmizade->error;
                }
            } else {
                echo 'Você já é amigo desse usuário.';
            }

            $stmtVerificarAmizade->close();
            $stmtInserirAmizade->close();
        } else {
            echo 'ID do usuário atual não especificado na sessão.';
        }
    } else {
        echo 'ID do usuário não especificado.';
    }
} else {
    echo 'Método de requisição inválido.';
}

// Sempre feche a conexão, independentemente do caminho seguido pelo código
$conn->close();
?>
