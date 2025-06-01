<?php
session_start();

// Desativar exibição de erros para evitar mensagens do XAMPP
error_reporting(0);
ini_set('display_errors', 0);

// Função para verificar se o CPF já está cadastrado
function verificarCpfExistente($cpf) {
    $caminhoArquivo = "usuarios/usuarios.txt";
    if (file_exists($caminhoArquivo)) {
        $arquivo = fopen($caminhoArquivo, "r");
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
    }
    return false;
}

// Função para verificar se o e-mail já está cadastrado
function verificarEmailExistente($email) {
    $caminhoArquivo = "usuarios/usuarios.txt";
    if (file_exists($caminhoArquivo)) {
        $arquivo = fopen($caminhoArquivo, "r");
        if ($arquivo) {
            while (($linha = fgets($arquivo)) !== false) {
                $dados = explode(",", trim($linha));
                if (count($dados) >= 4 && $dados[3] === $email) {
                    fclose($arquivo);
                    return true;
                }
            }
            fclose($arquivo);
        }
    }
    return false;
}

$erro = '';

// Cria os diretórios "usuarios", "saldos", "investimentos", "historico" e "limites" caso não existam
if (!is_dir('usuarios')) {
    mkdir('usuarios');
}
if (!is_dir('saldos')) {
    mkdir('saldos');
}
if (!is_dir('investimentos')) {
    mkdir('investimentos');
}
if (!is_dir('historico')) {
    mkdir('historico');
}
if (!is_dir('limites')) {
    mkdir('limites');
}

// Processa o cadastro
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmaSenha = trim($_POST['confirma-senha']);
    
    // Verifica se todos os campos foram preenchidos
    if (empty($nome) || empty($cpf) || empty($email) || empty($senha) || empty($confirmaSenha)) {
        $erro = "Por favor, preencha todos os campos.";
    } elseif ($senha !== $confirmaSenha) {
        $erro = "As senhas não correspondem.";
    } elseif (verificarCpfExistente($cpf)) {
        $erro = "CPF já cadastrado. Tente fazer login.";
    } elseif (verificarEmailExistente($email)) {
        $erro = "E-mail já cadastrado. Tente fazer login.";
    } else {
        // Adiciona o novo usuário ao arquivo usuarios.txt na pasta "usuarios"
        $arquivo = fopen("usuarios/usuarios.txt", "a");
        if ($arquivo) {
            // Grava os dados do usuário na nova linha
            fwrite($arquivo, "$cpf,$senha,$nome,$email" . PHP_EOL);  // Adiciona a quebra de linha com PHP_EOL
            fclose($arquivo);

            // Cria um arquivo de saldo específico para o usuário na pasta 
            file_put_contents("saldos/saldo_$cpf.txt", 0);

            file_put_contents("investimentos/investimentos_$cpf.txt", "");

            file_put_contents("historico/historico_$cpf.txt", "");

            file_put_contents("limites/limite_$cpf.txt", 1000.00);

            // Redireciona para a página de login
            $_SESSION['loggedin'] = true;
            $_SESSION['nome'] = $nome;
            $_SESSION['cpf'] = $cpf;
            $_SESSION['senha'] = $senha;
            header("Location: login.php");
            exit;
        } else {
            $erro = "Não foi possível criar o usuário.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../media-query/media-query-cadastro.css">

    <title>Cadastro - NeoBank</title>
    <script>
        // Funções para formatar CPF e telefone
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

        function formatarTelefone(telefone) {
            telefone = telefone.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (telefone.length > 11) {
                telefone = telefone.substring(0, 11);
            }
            telefone = telefone.replace(/^(\d{2})(\d)/, '($1) $2'); // Adiciona o código de área
            telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2'); // Adiciona o hífen
            return telefone;
        }

        // Função para aplicar o formato ao campo
        function aplicarFormato(event, tipo) {
            let input = event.target;
            if (tipo === 'cpf') {
                input.value = formatarCpf(input.value);
            } else if (tipo === 'telefone') {
                input.value = formatarTelefone(input.value);
            }
        }
    </script>
</head>
<body>
    <main>
        <section>
            <!-- Principal -->
            <div class="principal">
             <!-- lado da imagem e o texto -->
                    <article class="esquerdo">
                        <h1>Complete os campos ao lado para criar sua conta no Neo<a href="index.php">Bank</a></h1>
                    </article>
                    <!-- lado do formulário -->
                    <div class="direito">
                        <!-- Formulário de Cadastro -->
                        <form method="POST">
                            <label for="cpf">CPF</label>
                            <input id="cpf" name="cpf" type="text" oninput="aplicarFormato(event, 'cpf')" required />
        
                            <label for="nome">Nome completo</label>
                            <input id="nome" name="nome" type="text" required />
        
                            <label for="celular">Celular</label>
                            <input id="celular" name="celular" type="text" oninput="aplicarFormato(event, 'telefone')" required />
        
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="email" required />
        
                            <label for="senha">Senha</label>
                            <input id="senha" name="senha" type="password" required />
        
                            <label for="confirma-senha">Confirmar Senha</label>
                            <input type="password" id="confirma-senha" name="confirma-senha" required />
        
                            <div class="caixinha">
                                <input id="termos" name="termos" type="checkbox" required />
                                <p>Eu li, estou ciente das condições de tratamento dos meus dados pessoais e dou meu consentimento, quando aplicável, conforme descrito nesta
                                    <a href="politicas.php" target="_blank">Política de Privacidade</a>.</p>
                            </div>
                            <button class="btn-azul">Criar conta</button>
                        </form>
                        <?php if ($erro): ?><p class="erro"><?php echo $erro; ?></p><?php endif; ?>
                        <footer>
                            <br><br>
                            <!-- Link para a página de login -->
                            <a href="login.php"><button class="button-saibamais">Já possui uma conta? Faça o seu Login.</button></a>
                        </footer>
                        <br>
                    </div>
            </div>
        </section>
    </main>            
</body>
</html>
