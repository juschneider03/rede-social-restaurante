<?php
    
    include("conexao.php");
    
    $nome = $_POST['nome'];

    $query = "SELECT * FROM usuario WHERE nome LIKE '%$nome%'";
    $result = $conn->query($query);

    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='Perfil_pesquisa.php?id=" . $row['id_usuario'] . "'>" . $row['nome'] . "</a></li>";
    }
    echo "</ul>";

    $conn->close();
?>
