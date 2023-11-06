<?php
    $hostname = "localhost";
    $bancodedados = "restaurante";
    $usuario = "root";
    $senha = "root";

    $conn = new mysqli($hostname, $usuario, $senha, $bancodedados);
    if ($conn->connect_errno) {
        echo "falha ao conectar:(" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
    }
    else
        echo "Conectado ao Banco de Dados;"
?>