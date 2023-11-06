<?php
    include("conexao.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $texto = $_POST['texto']; // Recupere o texto da publicação do formulário
    
        // Você também pode adicionar lógica para obter o nome do autor, data e outros campos necessários
    
        $query = "INSERT INTO publicacoes (texto) VALUES ('$texto')";
        $result = $conn->query($query);
    
        if ($result) {
            echo 'success'; // Publicação salva com sucesso
        } else {
            echo 'error'; // Erro ao salvar a publicação
        }
    }
    
    $conn->close();
?>