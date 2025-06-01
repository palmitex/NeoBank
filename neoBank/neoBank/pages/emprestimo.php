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

// Carrega o saldo e limites de emréstimos do usuário e carrega seu cpf
$cpf = $_SESSION['cpf'];
$saldoArquivo = "saldos/saldo_$cpf.txt";
$limiteArquivo = "limites/limite_$cpf.txt";
$limiteMinimo = 100; // Crédito mínimo garantido

// Função para carregar a senha do arquivo de usuários
function carregarSenha($cpf) {
    $usuarioArquivo = "usuarios/usuarios.txt";
    if (file_exists($usuarioArquivo)) {
        $arquivo = fopen($usuarioArquivo, "r");
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(",", trim($linha));
            if ($dados[0] === $cpf) {
                fclose($arquivo);
                return $dados[1]; // Retorna a senha do arquivo
            }
        }
        fclose($arquivo);
    }
    return null;
}

// Função para calcular limite de crédito (mínimo garantido ou 50% do saldo)
function calcularLimite($saldo, $limiteMinimo) {
    return $saldo > 0 ? max($saldo * 0.5, $limiteMinimo) : $limiteMinimo;
}

// Inicializa saldo e limite na sessão, se necessário
if (!isset($_SESSION['saldo'])) {
    $saldo = file_exists($saldoArquivo) ? floatval(file_get_contents($saldoArquivo)) : 0;
    $_SESSION['saldo'] = $saldo;
    $_SESSION['limite'] = calcularLimite($saldo, $limiteMinimo);
}

// Carrega saldo e limite da sessão
$saldo = $_SESSION['saldo'];
$limite = $_SESSION['limite'];

// Inicializa variáveis de mensagens
$erro = '';
$sucesso = '';
$etapaSenha = false;
$valorEmprestimo = 0;

// Verifica se uma solicitação de empréstimo foi feita
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['etapa']) && $_POST['etapa'] === 'solicitar') {
        // Primeira etapa: valida o valor do empréstimo
        $valorEmprestimo = floatval($_POST['valor']);
        if ($valorEmprestimo > $limite) {
            $erro = "O valor solicitado excede o limite de crédito disponível.";
        } elseif ($valorEmprestimo <= 0) {
            $erro = "O valor do empréstimo deve ser maior que zero.";
        } else {
            $etapaSenha = true;
            $_SESSION['valorEmprestimo'] = $valorEmprestimo; // Armazena o valor na sessão
        }
    } elseif (isset($_POST['etapa']) && $_POST['etapa'] === 'confirmar') {
        // Segunda etapa: valida a senha
        $valorEmprestimo = $_SESSION['valorEmprestimo'] ?? 0;
        $senhaInserida = $_POST['senha'];
        $senhaCorreta = carregarSenha($cpf);

        if ($senhaInserida !== $senhaCorreta) {
            $erro = "Senha incorreta.";
            $etapaSenha = true;
        } else {
            // Aprova o empréstimo
            $saldo += $valorEmprestimo;

            // Recalcula o limite
            $limite = calcularLimite($saldo, $limiteMinimo);

            // Atualiza arquivos de saldo e limite
            file_put_contents($saldoArquivo, $saldo);
            file_put_contents($limiteArquivo, $limite);

            // Atualiza sessão
            $_SESSION['saldo'] = $saldo;
            $_SESSION['limite'] = $limite;

            $sucesso = "Empréstimo de R$ " . number_format($valorEmprestimo, 2, ',', '.') . " aprovado!";
            unset($_SESSION['valorEmprestimo']); // Limpa o valor do empréstimo da sessão

        }
    }
}

// Função para salvar a transação no histórico
function salvarTransacao($tipo, $valor) {
    global $cpf;
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("Y-m-d H:i:s");
    $transacao = "$data - $tipo: R$" . number_format($valor, 2, ',', '.') . PHP_EOL;
    file_put_contents("historico/historico_$cpf.txt", $transacao, FILE_APPEND);
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/emprestimocont.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Solicitação de Empréstimo</title>
    <style>
    @media screen and (max-width:700px){
            .container-emprestimo {
                width: 50%;
            }
 
            .emprestimo-content h1{
                font-size: 90%;
 
            }
 
            .emprestimo-content h1::after{
                display: none;
 
            }
        }
    </style>
</head>
<body>
    <main>

    <button onclick="goBack()" class="button-saibamais1"><img src="../img/arrow-left.svg">Voltar</button>
        <!-- javascript para que assim que o usuario clicar no botão de voltar, o navegador voltar uma página no histórico. -->
        <script>
            function goBack() {
                window.history.back();
            }
        </script>

    <!-- Conteúdo da página -->
    <div class="container-emprestimo">
        <!-- Informações sobre o empréstimo e dados do usuario -->
         <div class="emprestimo-content">
        <h1>Solicitação de Empréstimo</h1>
        <p>Saldo atual: R$ <?= number_format($saldo, 2, ',', '.') ?></p>
        <p>Limite de crédito disponível: R$ <?= number_format($limite, 2, ',', '.') ?></p>
         </div>

        <!--mensagens de verificação-->
        <?php if ($erro): ?>
            <p class="erro"><?= $erro ?></p>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <p style="color: green;"><?= $sucesso ?></p>
        <?php endif; ?>

        <!-- Formulário de senha -->
        <?php if ($etapaSenha): ?>
            <form method="post">
                <input type="hidden" name="etapa" value="confirmar">
                <input type="hidden" name="valor" value="<?= htmlspecialchars($valorEmprestimo) ?>">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
                <button type="submit" class="btn-azul">Confirmar Empréstimo</button>
            </form>
            <!-- Formulário de solicitação de empréstimo -->
        <?php else: ?>
            <form method="post">
                <input type="hidden" name="etapa" value="solicitar">
                <label for="valor">Valor do empréstimo (R$):</label>
                <input type="number" name="valor" id="valor" step="0.01" required>
                <button type="submit" class="btn-azul">Solicitar Empréstimo</button>
            </form>
        <?php endif; ?>
    </div>
    </main>
</body>
</html>
