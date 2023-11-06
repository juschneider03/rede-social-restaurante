<?php
    
    include("conexao.php")
    
    $nome  = $_POST['nome' ];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $info  = $_POST['informacoes'];
    $data_nascimento = $_POST['nascimento'];
    
    $sql = "INSERT INTO usuario (nome, email, senha, informacoes, nascimento) VALUES ('$nome', '$email', '$senha', '$informacoes', '$nascimento')";

    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        header("Location: index.html");
        exit();
    } else {
        echo 'error'; 
    }
    
    $conn->close();
?>