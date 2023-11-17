<?php
include("conexao.php");
session_start();

if (isset($_SESSION['id_usuario'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_usuario = $_SESSION['id_usuario'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data_nascimento = $_POST['datanascimento'];
        $informacoes = $_POST['mensagem'];

        // Atualize as informações do usuário no banco de dados
        $sql = "UPDATE usuario SET nome=?, email=?, senha=?, data_nascimento=?, informacoes=? WHERE id_usuario=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nome, $email, $senha, $data_nascimento, $informacoes, $id_usuario);

        if ($stmt->execute()) {
            header("Location: perfil.php");
            exit;
        } else {
            echo "Erro na atualização: " . $stmt->error;
        }
    }

    // Consulta para obter os dados do usuário
    $id_usuario = $_SESSION['id_usuario'];
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
} else {
    echo "Sessão não iniciada ou ID de usuário inválido.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="perfil.css">
    <title>Editar Perfil</title>
</head>
<body>
    <div id="menu">
        <a href="index.php"><i class="fas fa-home"></i> Início</a>
        <a href="perfil.php"><i class="fas fa-info-circle btnMenu"></i> Perfil</a>
        <a href="pesquisa.html"><i class="fas fa-search btnMenu"></i> Pesquisar</a>
    </div>

    <div class="main">
        <div class="newPost">
            <strong>Editar perfil</strong>
            
            <form class="form" method="post">
                <div class="form_grupo">
                    <label for="nome" class="form_label">Nome</label>
                    <input type="text" name="nome" class="form_input" id="nome" placeholder="Nome" required value="<?php echo $nome; ?>">
                </div>

                <div class "form_grupo">
                    <label for="e-mail" class="form_label">Email</label>
                    <input type="email" name="email" class="form_input" id="email" placeholder="seuemail@email.com" required value="<?php echo $email; ?>">
                </div>

                <div class "form_grupo">
                    <label for="senha" class="form_label">Senha</label>
                    <input type="text" name="senha" class="form_input" id="senha" placeholder="senha" required value="<?php echo $senha; ?>">
                </div>

                <div class="form_grupo">
                    <label for="datanascimento" class="form_label">Data de Nascimento</label>
                    <input type="date" name="datanascimento" class="form_input" id="datanascimento" required value="<?php echo $data_nascimento; ?>">
                </div>

                <div class="form_message">
                    <label for="message" class="form_label"> Bio:</label>
                    <textarea name="mensagem" id="message" cols="30" rows="3" class="form_input message_input" required><?php echo $informacoes; ?></textarea>
                </div>

                <button type="submit" class="btnSubmitForm">Editar</button>
            </form>
        </div>
    </div>
</body>
</html>
