<?php
include("conexao.php");

// Consulta para obter os dados do usuário logado (você precisará implementar o sistema de autenticação)
$sql = "SELECT * FROM usuario WHERE id_usuario = ?"; // Substitua ? pelo ID do usuário logado
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);

// Execute a consulta
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row["nome"];
        $email = $row["email"];
        $senha = $row["senha"];
        $data_nascimento = $row["data_nascimento"];
        $informacoes = $row["informacoes"];
    } else {
        echo "Nenhum usuário encontrado.";
    }
} else {
    echo "Erro na consulta: " . $stmt->error;
}

// Feche o statement
$stmt->close();

// Feche a conexão
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="perfil.css">
    <title>Perfil de <?php echo $nome; ?></title>
</head>
<body>
    <div id="menu">
        <a href="Index.html"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.html"><i class="fas fa-info-circle btnMenu"></i> Sobre</a>
        <a href="Pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>

    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong><?php echo $nome; ?></strong>
            </div>
            <div class="editarPerfil">
                <a class="btnEditar" href="editar-perfil.html">
                    <input type="button" value="Editar meu perfil" class="btn" />
                </a>
            </div>
            <div class="perfilInfo">
                <p>Email: <?php echo $email; ?></p>
                <p>Data de Nascimento: <?php echo $data_nascimento; ?></p>
                <p>Informações: <?php echo $informacoes; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
