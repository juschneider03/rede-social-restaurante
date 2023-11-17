<?php
    include("conexao.php");
    
    if (isset($_GET['id'])) {
        $id_usuario = $_GET['id'];
    
        // Consulta para obter os dados do usuário
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
    
        // Execute the query
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nome = $row["nome"];
                $email = $row["email"];
                $data_nascimento = $row["data_nascimento"];
                $informacoes = $row["informacoes"];
            } else {
                echo "Nenhum usuário encontrado.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="perfil.css">
    <title>Perfil <?php echo $nome; ?></title>
</head>
<body>
    <div id="menu">
        <a href="Index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="Pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>

    <div class="main">
        <div class="newPost">
            <div class="infoUser">
            <div class="name">
                    <div class="imgUser"></div>
                    <strong><?php echo $nome; ?></strong>
                </div>
                <div class="comentarios">
                    <strong>123 comentários</strong>
                </div>
            </div>
            <div class="amizade">
            <form action="adicionar_amigo.php" method="post">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <input type="submit" value="+ Adicionar amigo" class="btnAmizade" />
            </form>
                <div class="perfilInfo">
                    <p class="info">Informações do usuário:</p>
                    <p>Email: <?php echo $email; ?></p>
                    <p>Data de Nascimento: <?php echo $data_nascimento; ?></p>
                    <p>Informações: <?php echo $informacoes; ?></p>
                </div>
            </div>
        </div>
    </div> 
    <script type="module" src="/controller/FormPost.js"></script>
</body>
</html> 