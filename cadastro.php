<?php
session_start();

// Desativar exibição de erros para evitar mensagens do XAMPP
error_reporting(0);
ini_set('display_errors', 0);

function verificarCpfExistente($cpf) {
    $arquivo = fopen("usuarios.txt", "r");
    if ($arquivo) {
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(",", trim($linha));
            if (count($dados) >= 2 && $dados[0] === $cpf) {
                fclose($arquivo);
                return true;
            }
        }
        fclose($arquivo);
    }
    return false;
}

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Verifica se todos os campos foram preenchidos
    if (empty($nome) || empty($cpf) || empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (verificarCpfExistente($cpf)) {
        $erro = "CPF já cadastrado. Tente fazer login.";
    } else {
        // Adiciona o novo usuário ao arquivo usuarios.txt
        $arquivo = fopen("usuarios.txt", "a");
        fwrite($arquivo, "$cpf,$senha,$nome,$email\n");
        fclose($arquivo);

        // Define o usuário como logado e redireciona para a página inicial
        $_SESSION['loggedin'] = true;
        $_SESSION['nome'] = $nome;
        $_SESSION['cpf'] = $cpf;
        
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="button">Cadastrar</button>
        </form>

        <?php if ($erro): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <a href="login.php" class="button">Já possui uma conta? Faça Login</a>
    </div>
</body>
</html>
