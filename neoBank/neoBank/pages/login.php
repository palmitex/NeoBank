<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();


$erro = '';
$mensagem = '';
$mostrarFormulario = 'login'; // Variável para alternar entre os formulários

// Detecta se o usuário clicou em "Esqueci a senha" e muda o formulário a ser exibido
if (isset($_GET['acao']) && $_GET['acao'] === 'esqueceu_senha') {
    $mostrarFormulario = 'esqueceuSenha';
}

// Função para verificar o login
function verificarLogin($cpf, $senha) {
    $caminhoArquivo = "usuarios/usuarios.txt";
    if (file_exists($caminhoArquivo)) {
        $arquivo = fopen($caminhoArquivo, "r");
        if ($arquivo) {
            while (($linha = fgets($arquivo)) !== false) {
                $dados = explode(",", trim($linha));
                if (count($dados) >= 2 && $dados[0] === $cpf && $dados[1] === $senha) {
                    fclose($arquivo);
                    $_SESSION['nome'] = $dados[2]; // Adiciona o nome do usuário à sessão
                    return true;
                }
            }
            fclose($arquivo);
        }
    }
    return false;
}

// Processa o login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'login') {
    $cpf = trim($_POST['cpf']);
    $senha = trim($_POST['senha']);

    if (empty($cpf) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (verificarLogin($cpf, $senha)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['cpf'] = $cpf;
        header("Location: index.php"); //manda para a home da pagina
        exit;
    } else {
        $erro = "CPF ou senha incorretos.";
    }
}

// Processa a recuperação de senha
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'esqueceu_senha') {
    $identificacao = trim($_POST['identificacao']);

    if (empty($identificacao)) {
        $erro = "Por favor, insira o seu e-mail ou telefone.";
        $mostrarFormulario = 'esqueceuSenha';
    } else {
        $arquivo = fopen("usuarios/usuarios.txt", "r"); // Caminho para o arquivo dentro da pasta 'dados'
        $encontrado = false;
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(",", trim($linha));
            if (count($dados) >= 4 && $dados[3] === $identificacao) { // A quarta posição é o e-mail ou telefone
                $_SESSION['cpf'] = $dados[0]; // Armazena o CPF do usuário para redefinir a senha
                $encontrado = true;
                break;
            }
        }
        fclose($arquivo);

        if ($encontrado) {
            $mensagem = "Insira uma nova senha.";
            $mostrarFormulario = 'novaSenha';
        } else {
            $erro = "E-mail ou telefone não encontrado.";
            $mostrarFormulario = 'esqueceuSenha';
        }
    }
}

// Processa a redefinição de senha
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'nova_senha') {
    $novaSenha = trim($_POST['novaSenha']);
    $confirmarSenha = trim($_POST['confirmarSenha']);
    $cpf = $_SESSION['cpf'];

    if (empty($novaSenha) || empty($confirmarSenha)) {
        $erro = "Por favor, preencha todos os campos.";
        $mostrarFormulario = 'novaSenha';
    } elseif ($novaSenha !== $confirmarSenha) {
        $erro = "As senhas não coincidem.";
        $mostrarFormulario = 'novaSenha';
    } else {
        $linhas = file("usuarios/usuarios.txt", FILE_IGNORE_NEW_LINES);
        foreach ($linhas as &$linha) {
            $dados = explode(",", $linha);
            if ($dados[0] === $cpf) {
                $dados[1] = $novaSenha; // Atualiza apenas a senha para o CPF correspondente
                $linha = implode(",", $dados);
                break;
            }
        }
        file_put_contents("usuarios/usuarios.txt", implode(PHP_EOL, $linhas));
        $mensagem = "Senha alterada com sucesso. Faça login com a nova senha.";
        unset($_SESSION['cpf']); // Remove o CPF da sessão
        header("Location: login.php");
        exit;
    }
}

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NeoBank</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../media-query/media-query_login.css">
    <script>
    function formatarCpf(cpf) {
        cpf = cpf.replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cpf.length > 11) {
            cpf = cpf.substring(0, 11);
        }
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o hífen
        return cpf;
    }

    function aplicarFormato(event) {
        let input = event.target;
        input.value = formatarCpf(input.value);
    }
</script>
</head>
<body>
<main>
    <section>
       <div class="principal">
           <article class="esquerdo">
               <h1>Acesse sua conta no Neo<a href="index.php">Bank</a> e veja seus benefícios</h1>
           </article>

           <!-- Formulário de Login -->
           <?php if ($mostrarFormulario === 'login'): ?>
           <div class="direito">
               <form method="POST">
                   <input type="hidden" name="acao" value="login">
                   <label for="cpf">CPF</label>
                   <input id="cpf" name="cpf" type="text" required maxlength="14" oninput="aplicarFormato(event)" />
                   
                   <label for="senha">Senha</label>
                   <input id="senha" name="senha" type="password" required />
                   <button class="btn-azul">Entrar</button>

                   <div class="box-btns">
                   <a href="?acao=esqueceu_senha"><button class="button-saibamais" type ="button">Esqueci a senha</button></a>
                   <a href="cadastro.php"><button class="button-saibamais" type="button">Ainda não tem uma conta? Cadastre-se.</button></a>
                   </div>
               </form>
               <?php if ($erro): ?><p class="erro"><?php echo $erro; ?></p><?php endif; ?>
               <?php if ($mensagem): ?><p class="mensagem"><?php echo $mensagem; ?></p><?php endif; ?>
           </div>
           <?php endif; ?>

           <!-- Formulário de Recuperação de Senha -->
           <?php if ($mostrarFormulario === 'esqueceuSenha'): ?>
           <div class="direito">
               <h2>Recuperação de Senha</h2>
               <form method="POST">
                   <input type="hidden" name="acao" value="esqueceu_senha">
                   <label for="identificacao">E-mail ou Telefone:</label>
                   <input type="text" name="identificacao" id="identificacao" required>
                   <button type="submit" class="btn-azul">Enviar Código</button>
               </form>
               <?php if ($erro): ?><p class="erro"><?php echo $erro; ?></p><?php endif; ?>
               <a href="?acao=login"><button class="button-saibamais">Voltar ao login</button></a>
           </div>
           <?php endif; ?>

           <!-- Formulário de Redefinição de Senha -->
           <?php if ($mostrarFormulario === 'novaSenha'): ?>
           <div class="direito">
               <h2>Redefinir Senha</h2>
               <form method="POST">
                   <input type="hidden" name="acao" value="nova_senha">
                   <label for="novaSenha">Nova Senha:</label>
                   <input type="password" name="novaSenha" id="novaSenha" required>
                   
                   <label for="confirmarSenha">Confirme a Nova Senha:</label>
                   <input type="password" name="confirmarSenha" id="confirmarSenha" required>
                   <button type="submit" class="btn-azul">Redefinir Senha</button>
               </form>
               <?php if ($erro): ?><p class="erro"><?php echo $erro; ?></p><?php endif; ?>
           </div>
           <?php endif; ?>
       </div>
    </section>
</main>
</body>
</html>
