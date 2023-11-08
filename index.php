<?php
    include("conexao.php");
    session_start(); // Inicie a sessão

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta para obter os dados do usuário
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
        } else {
            echo "Nenhum usuário encontrado.";
        }
    } else {
        echo "Erro na consulta: " . $stmt->error;
    }

    // Feche o statement
    $stmt->close();
} else {
    echo "Sessão não iniciada ou ID de usuário inválido.";
}

// Feche a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Restaurante</title>
    
</head>
<body>
    <div id="menu">
        <a href="Index.php"><i class="fas fa-home"></i> Início</a>
        <a href="Perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="Pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>
  
    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong><?php echo $nome; ?></strong>
            </div>

            <form action="Postagem.php" class="formPost" id="formPost">
              <textarea name="textarea" placeholder="O que você comeu hoje?" id="textarea"></textarea>
                <div class="iconsAndButton">
                    <div class="icon">
                        <input style="display: none" type="file" accept="image/png" id="input-imagens" name="post_imagem"/>
                        <button id="button-imagens" class="btnFileForm"><img src="./imagens/img.svg" alt="Adicionar uma imagem"></button>
                    </div>
                    <button type="submit" class="btnSubmitForm">Publicar</button>
                </div>
            </form>
        </div>
        
        <ul class="posts" id="posts"></ul>
    </div> 
    <script src="./controller/FormPost.js"></script>
    <script src="./controller/ControleBotoesPost.js"></script>
</body>
</html>
