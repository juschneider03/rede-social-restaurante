<?php
    $hostname = "localhost";
    $bancodedados = "bd_restaurante";
    $usuario = "root";
    $senha = "";

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Conexão ao banco de dados falhou: " . $conn->connect_error);
    }

    $nome = $_POST['nome'];

    $query = "SELECT * FROM tabela_usuarios WHERE nome LIKE '%$nome%'";
    $result = $conn->query($query);

    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='perfil.php?id=" . $row['id'] . "'>" . $row['nome'] . "</a></li>";
    }
    echo "</ul>";

    $conn->close();
?>