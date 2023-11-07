<?php
    
    include("conexao.php")
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $informacoes = $_POST["informacoes"];
        $nascimento = $_POST["nascimento"];
    
        // Faça a validação dos dados, como checar se os campos são obrigatórios, etc.
        
        // Insira os dados no banco de dados
        $query = "INSERT INTO usuario (nome, email, senha, informacoes, nascimento) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $nome, $email, $senha, $informacoes, $nascimento);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($connection);
        }
        
        mysqli_stmt_close($stmt);
    }
?>