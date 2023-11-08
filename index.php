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
        <a href="Index.html"><i class="fas fa-home"></i> Início</a>
        <a href="Perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="Pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>
  
    <div class="main">
        <div class="newPost">
            <div class="infoUser">
                <div class="imgUser"></div>
                <strong>Juliana</strong>
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