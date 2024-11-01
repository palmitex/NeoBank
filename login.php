<?php
session_start();

// Desativar exibição de erros para evitar mensagens do XAMPP
error_reporting(0);
ini_set('display_errors', 0);

function verificarLogin($cpf, $senha) {
    $arquivo = fopen("usuarios.txt", "r");
    if ($arquivo) {
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(",", trim($linha));
            if (count($dados) >= 2 && $dados[0] === $cpf && $dados[1] === $senha) {
                fclose($arquivo);
                return true; // Usuário encontrado
            }
        }
        fclose($arquivo);
    }
    return false; // Usuário não encontrado
}

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cpf = trim($_POST['cpf']);
    $senha = trim($_POST['senha']);

    // Verifica se todos os campos foram preenchidos
    if (empty($cpf) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (verificarLogin($cpf, $senha)) {
        // Define o usuário como logado e redireciona para a página inicial
        $_SESSION['loggedin'] = true;
        $_SESSION['cpf'] = $cpf;
        
        header("Location: index.php");
        exit;
    } else {
        $erro = "CPF ou senha incorretos. Tente novamente.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <a href="cadastro.php">Ainda não tem uma conta? Crie uma agora!</a>
        <br>
        <input type="submit" value="Login">
    </form>
    <?php if ($erro): ?>
        <p style="color:red;"><?php echo $erro; ?></p>
    <?php endif; ?>
</body>
</html>


