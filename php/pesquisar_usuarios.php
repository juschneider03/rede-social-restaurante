<?php
    
    include("conexao.php")
    
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
