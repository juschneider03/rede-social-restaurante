<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row["nome"];
            $email = $row["email"];
            $data_nascimento = $row["data_nascimento"];
            $informacoes = $row["informacoes"];
        } 
    }

    $quantPostagens = "SELECT count(*) as total_postagens FROM postagens WHERE usuario = ?";
    $stmt = $conn->prepare($quantPostagens);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_postagens = $row["total_postagens"];
        } 
    }

    $postagens_sql = "SELECT * FROM postagens WHERE usuario = ?";
    $stmt_postagens = $conn->prepare($postagens_sql);
    $stmt_postagens->bind_param("i", $id_usuario);

    if ($stmt_postagens->execute()) {
        $result_postagens = $stmt_postagens->get_result();
        $postagens = array();

        while ($row_postagens = $result_postagens->fetch_assoc()) {
            $postagens[] = $row_postagens;
        }
    }
    $stmt_postagens->close();

    $stmt->close();
} else {
    $conn->close();
}
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
        <a href="index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>

    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="name">
                    <div class="imgUser"></div>
                    <strong><?php echo $nome; ?></strong>
                </div>
                <div class="comentarios">
                    <strong><?php echo $total_postagens; ?> comentários</strong>
                </div>
            </div>
            <div class="editarPerfil">
                <a class="btnEditar" href="editar_perfil.php">
                    <input type="button" value="Editar meu perfil" class="btn" />
                </a>
            </div>
            
            <div class="perfilInfo">
                <p class="info">Informações do usuário:</p>
                <p>Email: <?php echo $email; ?></p>
                <p>Data de Nascimento: <?php echo $data_nascimento; ?></p>
                <p>Informações: <?php echo $informacoes; ?></p>
            </div>

            <?php
            foreach ($postagens as $postagem) {
                echo "<li class='post'>";
                echo "<div class='infoUserPost'>";
                echo "<div class='imgUserPost'></div>";
                echo "<div class='nameAndHour'>";
                echo "<strong>" . $nome . "</strong>";
                //echo "<p>" . date('Y-m-d H:i:s', strtotime($post['data_post'])) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "<p>" . $postagem['comentario'] . "</p>";
                echo "</li>";
            }
            ?>

        </div>
    </div>
</body>

</html>