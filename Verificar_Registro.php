<?php
    
    include("conexao.php")
    
    $nome  = $_POST['nome' ];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $info  = $_POST['informacoes'];
    $data_nascimento = $_POST['nascimento'];
    
    $query = "SELECT * FROM tabela_usuario WHERE nome = '$nome' AND email = '$email' AND
    senha = '$senha' AND informacoes = '$info' AND nascimento = '$data_nascimento'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        header("Location: index.html");
        exit();
    } else {
        echo 'error'; 
    }
    
    $conn->close();
?>