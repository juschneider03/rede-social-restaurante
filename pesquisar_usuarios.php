<?php
    include("conexao.php");
    session_start();

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
}

    $nome = $_POST['nome'];

    $query = "SELECT * FROM usuario WHERE nome LIKE '%$nome%'";
    $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="pesquisa.css">
    <title>Pesquisa de Usuários</title>
</head>
<body>
    <div id="menu">
        <a href="index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>
    <div class="corpo">
        <div class="subcorpo">
            <h1>Pesquisar Usuários</h1>
            <form action="pesquisar_usuarios.php" method="POST">
                <input id="nome-usuario" type="text" name="nome" placeholder="Nome do usuário" autofocus="true"/>
                <button type="submit">Pesquisar</button>
            </form>
            <div id="resultados">
                <ul class="search-results">
                <?php while ($row = $result->fetch_assoc()) : ?>
                <?php
                $id_resultado = $row['id_usuario'];
                $link_perfil = ($id_resultado == $_SESSION['id_usuario']) ? 'Perfil.php' : 'Perfil_pesquisa.php?id=' . $id_resultado;
                ?>
                <li><a href="<?= $link_perfil ?>"><?= $row['nome'] ?></a></li>
            <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
