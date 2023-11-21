<?php
    
    include("conexao.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $informacoes = $_POST["informacoes"];
        $data_nascimento = $_POST["data_nascimento"];
    
        $query = "INSERT INTO usuario (nome, email, senha, informacoes, data_nascimento) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $senha, $informacoes, $data_nascimento);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Dados inseridos com sucesso!";
            header("Location: login.html");
        exit();
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($conn);
        }
        
        mysqli_stmt_close($stmt);
    }
?>