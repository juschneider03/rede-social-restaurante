<?php
    include("conexao.php");
    
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    
        // Consulta para obter os dados do usuário
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
    
    // Execute a consulta
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
    <title>Restaurante</title>
</head>
<body>
    <div id="menu">
        <a href="Index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Sobre</a>
        <a href="Pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>

    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong>TESTE</strong>
            </div>
            <div class="editarPerfil">
                <a class="btnEditar" href="editar-perfil.html">
                    <input type="button" value="Editar meu perfil" class="btn" />
                </a>
                <input type="button" value="+ Adicionar amigo" class="btnAmizade" />
            </div>
        </div>
    </div> 
    <script type="module" src="/controller/FormPost.js"></script>
</body>
</html>