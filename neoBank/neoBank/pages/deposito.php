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
 
// Carrega o saldo do usuário e verifica o cpf do usuário
$cpf = $_SESSION['cpf'];
$saldoArquivo = "saldos/saldo_$cpf.txt";
 
// Função para carregar a senha do arquivo de usuários
function carregarSenha($cpf) {
    $usuarioArquivo = "usuarios/usuarios.txt";
    if (file_exists($usuarioArquivo)) {
        $arquivo = fopen($usuarioArquivo, "r");
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(",", trim($linha));
            if ($dados[0] === $cpf) {
                fclose($arquivo);
                return $dados[1];  // Retorna a senha do arquivo
            }
        }
        fclose($arquivo);
    }
    return null;  // Retorna null se o arquivo não existir
}
 
// Carrega o saldo do usuário
$saldo = file_exists($saldoArquivo) ? floatval(file_get_contents($saldoArquivo)) : 0;
$erro = '';
 
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valorDeposito = (float) $_POST['valor'];
    $senha = $_POST['senha'];
 
    // Carrega a senha do arquivo de usuários
    $senhaArquivo = carregarSenha($cpf);
 
    // Valida o depósito
    if ($valorDeposito <= 0) {
        $erro = "Valor de depósito inválido.";
    } elseif ($senha !== $senhaArquivo) {  // Comparando a senha com a do arquivo
        $erro = "Senha incorreta.";
    } else {
        // Atualiza o saldo e salva a transação
        $saldo += $valorDeposito;
        file_put_contents($saldoArquivo, $saldo);
        salvarTransacao("Depósito", $valorDeposito);
        $erro = "Depósito realizado com sucesso!";
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Depósito - NeoBank</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <script>
        // Função para alternar a visibilidade do saldo
        function toggleSaldo() {
            const saldoElement = document.getElementById("saldo");
            const eyeIcon = document.getElementById("eyeIcon");
           
            // Alterna visibilidade do saldo
            if (saldoElement.textContent === "••••••") {
                saldoElement.textContent = "<?php echo number_format($saldo, 2, ',', '.'); ?>";
                eyeIcon.src = "../img/eye-slash.svg";
                eyeIcon.alt = "Ocultar Saldo";
            } else {
                saldoElement.textContent = "••••••";
                eyeIcon.src = "../img/eye.svg";
                eyeIcon.alt = "Mostrar Saldo";
            }
        }
 
        // Funções para o teclado numérico
        let valorSelecionado = '';
 
        function adicionarNumero(numero) {
            valorSelecionado += numero;
            valorSelecionado = valorSelecionado.replace(/^0+/, ''); // Remove zeros à esquerda
 
            const valor = parseInt(valorSelecionado, 10) || 0;
            const valorFormatado = (valor / 100).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
 
            document.getElementById("valor-display").value = `R$ ${valorFormatado}`;
        }
 
        function limparValor() {
            valorSelecionado = '';
            document.getElementById("valor-display").value = 'R$ 0,00';
        }
 
        function confirmarValor() {
            if (valorSelecionado) {
                const valorFinal = parseFloat(valorSelecionado) / 100;
                document.getElementById("valor").value = valorFinal.toFixed(2);
 
                document.getElementById("campo-valor").style.display = "none";
                document.getElementById("campo-senha").style.display = "block";
            }
        }
 
        // Função para voltar à página anterior
        function goBack() {
            window.history.back();
        }
    </script>
</head>
<body>
    <main>
        <button onclick="goBack()" class="button-saibamais"><img src="../img/arrow-left.svg">Voltar</button>
        <div class="container">
            <div class="container-content">
                <h1>Depósito</h1>
                <p>Saldo Atual: R$ <span id="saldo"><?php echo number_format($saldo, 2, ',', '.'); ?></span>
                    <img id="eyeIcon" src="../img/eye.svg" alt="Mostrar Saldo" class="eye-icon" onclick="toggleSaldo()" style="width: 30px; height: 30px; cursor: pointer; vertical-align: middle;">
                </p>
            </div>
 
            <!-- Campo de valor e teclado numérico -->
            <div id="campo-valor">
                <input type="text" id="valor-display" placeholder="R$ 0,00" readonly>
 
                <!-- Teclado numérico -->
                <div class="teclado">
                    <button onclick="adicionarNumero('1')">1</button>
                    <button onclick="adicionarNumero('2')">2</button>
                    <button onclick="adicionarNumero('3')">3</button>
                    <button onclick="adicionarNumero('4')">4</button>
                    <button onclick="adicionarNumero('5')">5</button>
                    <button onclick="adicionarNumero('6')">6</button>
                    <button onclick="adicionarNumero('7')">7</button>
                    <button onclick="adicionarNumero('8')">8</button>
                    <button onclick="adicionarNumero('9')">9</button>
                    <button onclick="limparValor()"><img src="../img/x-branco.svg"></button>
                    <button onclick="adicionarNumero('0')">0</button>
                    <button onclick="confirmarValor()"><img src="../img/setaBranca.svg"></button>
                </div>
            </div>
 
            <!-- Campo de senha exibido após a confirmação do valor -->
            <form method="post">
                <input type="hidden" id="valor" name="valor">
               
                <div id="campo-senha" style="display: none;">
                    <label for="senha">Confirme sua Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="submit" class="btn-azul">Confirmar Depósito</button>
                </div>
            </form>
 
            <?php if ($erro): ?>
                <p class="erro"><?php echo $erro; ?></p>
            <?php endif; ?>
 
        </div>
    </main>
</body>
</html>