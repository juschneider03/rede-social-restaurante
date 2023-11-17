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
        <a href="index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>
  
    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong><?php echo $nome; ?></strong>
            </div>

            <form action="salvar_publicacao.php" class="formPost" id="formPost">
              <textarea name="textarea" placeholder="O que você comeu hoje?" id="textarea1"></textarea>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
    carregarPublicacoes();

    $("#formPost").submit(function (e) {
        e.preventDefault();
        var comentario = $("#textarea1").val();  // Capturar o valor do textarea

        $.ajax({
            type: "POST",
            url: "salvar_publicacao.php",
            data: { textarea: comentario },  // Enviar o valor do textarea
            success: function (response) {
                if (response === "success") {
                    // Limpar e recarregar as publicações
                    $("#textarea").val("");
                    carregarPublicacoes();
                } else {
                    alert("Erro ao salvar a publicação.");
                }
            },
        });
    });

    function carregarPublicacoes() {
        $.ajax({
            type: "GET",
            url: "recuperar_publicacoes.php",
            dataType: "json",
            success: function (data) {
                exibirPublicacoes(data);
            },
        });
    }

    function exibirPublicacoes(publicacoes) {
        $("#posts").empty();
        publicacoes.forEach(function (post) {
            $("#posts").append(`
                <li class="post">
                    <div class="infoUserPost">
                        <div class="imgUserPost"></div>
                        <div class="nameAndHour">
                            <strong>${post.nome}</strong>
                            <p>${new Date(post.data_post).toLocaleString()}</p>
                        </div>
                    </div>
                    <p>${post.comentario}</p>
                    <div class="actionBtnPost">
                        <button type="button" class="filesPost like">
                        <img src="./imagens/heart.svg" alt="Curtir">
                            Curtir
                        </button>
                    </div>
                </li>
            `);
        });
    }
});
</script>
</body>
</html>
