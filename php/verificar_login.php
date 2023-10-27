<?php
    $hostname = "localhost";
    $bancodedados = "restaurantes";
    $usuario = "root";
    $senha = "";

    $conn = new mysqli($hostname, $usuario, $senha, $bancodedados);

    if ($conn->connect_error) {
        die("Conexão ao banco de dados falhou: " . $conn->connect_error);
    }
    else
    echo "Conectado ao Banco de Dados;"
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $query = "SELECT * FROM tabela_usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        header("Location: index.html");
        exit();
    } else {
        echo 'error'; 
    }
    
    $conn->close();
?>


