<?php
    
    include("conexao.php");
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        header("Location: index.html");
        exit();
    } else {
        echo 'error'; 
    }
    
    $conn->close();
?>
