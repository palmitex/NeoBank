<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão
// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Função para verificar se o login é válido (verifica CPF, e-mail e senha)
function verificarLogin($cpf, $email, $senha) {
    $caminhoArquivo = "usuarios/usuarios.txt";
    
    if (file_exists($caminhoArquivo)) {
        $arquivo = fopen($caminhoArquivo, "r");
        if ($arquivo) {
            while (($linha = fgets($arquivo)) !== false) {
                // Divide os dados do usuário (CPF, senha, nome, e-mail)
                $dados = explode(",", trim($linha));
                
                // Verifica se o CPF, e-mail e senha estão corretos
                if (count($dados) >= 4 && $dados[0] === $cpf && $dados[1] === $senha && $dados[3] === $email) {
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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'login') {
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($cpf) || empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif (verificarLogin($cpf, $email, $senha)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['cpf'] = $cpf;
        header("Location: index.php"); // Redireciona para a página inicial (home)
        exit;
    } else {
        $erro = "CPF, e-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/forms.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Solicitar Cartão</title>
    <script>
        function aplicarMascaraCPF(input) {
            let valor = input.value;
            // Remove tudo que não for número
            valor = valor.replace(/\D/g, "");

            // Adiciona a máscara
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

            input.value = valor;
        }

        function aplicarMascaraCPF(input) {
            let valor = input.value;
            valor = valor.replace(/\D/g, ""); // Remove tudo que não for número
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            input.value = valor;
        }
 
        function exibirMensagem() {
            const mensagem = document.getElementById('mensagem-confirmacao');
            mensagem.style.display = 'block'; // Exibe a mensagem
        }
 
        function redirecionarParaIndex() {
            window.location.href = 'index.php'; // Redireciona para index.php
        }
    </script>
</head>
<body>
    <div class="formulario">
        <div class="imagem">
            <img src="../img/cards-form.svg">
        </div>
        <div class="forms">
            <form method="post" onsubmit="exibirMensagem(); return false;"> <!-- Impede o envio real -->
                <div class="formTitulo">
                    <div class="titulo">
                        <h1>Solicite Agora</h1>
                    </div>
                    <div class="voltar">
                        <a href="cards.php">
                            <button class="button-saibamais" type="button">Voltar</button>
                        </a>
                    </div>
                </div>
                <div class="informacoes">
                    <div class="info">
                        <label>CPF</label>
                        <input type="text" name="cpf" placeholder="Digite seu CPF" oninput="aplicarMascaraCPF(this)" maxlength="14" required>
                    </div>

                    <div class="info">
                        <label>CEP</label>
                        <input type="number" name="cep" placeholder="Digite seu CEP" required>
                    </div>

                    <div class="info">
                        <label>Endereço</label>
                        <input type="text" name="endereco" placeholder="Digite seu endereço" required>
                    </div>

                    <div class="info">
                        <label>N°</label>
                        <input type="number" name="numero" placeholder="Digite o número" required>
                    </div>

                    <div class="info">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="info">
                        <label for="password">Senha</label>
                        <input type="password" name="senha" placeholder="Digite sua senha" required>
                    </div>
                </div>
                <div class="checkBox">
                    <div class="checkTitulo">
                        <h6>Linha do Cartão</h6>
                    </div>

                    <div class="selecao">
                        <div class="escolha">
                            <input type="radio" name="cartao" value="basico">
                            <label>Básico</label>
                        </div>

                        <div class="escolha">
                            <input type="radio" name="cartao" value="neoblack">
                            <label>NeoBlack</label>
                        </div>
                    </div>
                </div>
                <div class="enviar">
                    <button type="submit" name="acao" value="login" class="btn-azul">Enviar</button>
                </div>
            </form>

            <!-- Exibe a mensagem de erro abaixo do botão de envio -->
            <?php if (isset($erro)): ?>
                <p class="erro"><?= $erro ?></p>
            <?php endif; ?>

            <!-- Mensagem de confirmação -->
            <div id="mensagem-confirmacao">
                <p>Cartão enviado com sucesso!</p>
                <button onclick="redirecionarParaIndex()">OK</button>
            </div>
        </div>
    </div>
</body>
</html>

