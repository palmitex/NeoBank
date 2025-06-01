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
 
$cpf = $_SESSION['cpf'];
$saldoArquivo = "saldos/saldo_$cpf.txt";
 
// Função para carregar a senha do arquivo de usuários
function carregarSenha($cpf)
{
    $usuarioArquivo = "usuarios/usuarios.txt";  // Caminho do arquivo de senha
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
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Substitui vírgulas por pontos e converte o valor para float
    $valorSaque = str_replace(',', '.', $_POST['valor']);
    $valorSaque = floatval($valorSaque);
    $senha = $_POST['senha'];
 
    // Carrega a senha do arquivo de usuários
    $senhaArquivo = carregarSenha($cpf);
 
    // Valida o saque
    if ($valorSaque <= 0) {
        $erro = "Valor de saque inválido.";
    } elseif ($valorSaque > $saldo) {
        $erro = "Saldo insuficiente.";
    } elseif ($senha !== $senhaArquivo) {  // Comparando a senha com a do arquivo
        $erro = "Senha incorreta.";
    } else {
        // Atualiza o saldo e salva a transação
        $saldo -= $valorSaque;
        file_put_contents($saldoArquivo, $saldo);
        salvarTransacao("Saque", $valorSaque);
        $erro = "Saque realizado com sucesso!";
    }
}
 
// Função para salvar a transação no histórico
function salvarTransacao($tipo, $valor)
{
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
    <title>Saque - NeoBank</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <style>
        .title {
            width: 100%;
            justify-items: center;
        }
 
        .btn-azul {
            height: 40px;
            width: 150px;
            margin-top: 20px;
        }
    </style>
    <script>
        let valorSelecionado = '';
 
        function adicionarNumero(numero) {
            valorSelecionado += numero;
 
            // Remove zeros à esquerda
            valorSelecionado = valorSelecionado.replace(/^0+/, '');
 
            // Formata o valor para moeda (centavos incluídos automaticamente)
            const valor = parseInt(valorSelecionado, 10) || 0;
            const valorFormatado = (valor / 100).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
 
            // Atualiza o display
            document.getElementById("valor-display").value = `R$ ${valorFormatado}`;
        }
 
        function limparValor() {
            valorSelecionado = '';
            document.getElementById("valor-display").value = 'R$ 0,00';
        }
 
        function confirmarValor() {
            if (valorSelecionado) {
                const valorFinal = (parseInt(valorSelecionado, 10) || 0) / 100;
                document.getElementById("valor").value = valorFinal.toFixed(2); // Atualiza o campo oculto
 
                // Esconde o teclado e exibe o campo de senha
                document.getElementById("campo-valor").style.display = "none";
                document.getElementById("campo-senha").style.display = "block";
            }
        }
 
        function toggleSaldo() {
            const saldoElement = document.getElementById("saldo");
            const eyeIcon = document.getElementById("eyeIcon");
 
            if (saldoElement.textContent === "••••••") {
                saldoElement.textContent = "<?php echo number_format((float)$saldo, 2, ',', '.'); ?>";
                eyeIcon.src = "../img/eye-slash.svg";
                eyeIcon.alt = "Ocultar Saldo";
            } else {
                saldoElement.textContent = "••••••";
                eyeIcon.src = "../img/eye.svg";
                eyeIcon.alt = "Mostrar Saldo";
            }
        }
 
        function goBack() {
            window.history.back();
        }
    </script>
</head>
 
<body>
    <main>
        <button onclick="goBack()" class="button-saibamais"><img src="../img/arrow-left.svg">Voltar</button>
 
        <div class="container">
            <div class="title">
                <h1>Saque</h1>
            </div>
            <p>Saldo Atual: R$ <span id="saldo"><?php echo number_format((float)$saldo, 2, ',', '.'); ?></span>
                <img id="eyeIcon" src="../img/eye.svg" alt="Mostrar Saldo" class="eye-icon" onclick="toggleSaldo()" style="width: 30px; height: 30px; cursor: pointer; vertical-align: middle;">
            </p>
 
            <div id="campo-valor">
                <input type="text" id="valor-display" placeholder="R$ 0,00" readonly>
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
 
            <form method="post">
                <input type="hidden" id="valor" name="valor">
                <div id="campo-senha" style="display: none;">
                    <label for="senha">Confirme sua Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="submit" class="btn-azul">Confirmar Saque</button>
                </div>
            </form>
 
            <?php if ($erro): ?>
                <p class="erro"><?php echo $erro; ?></p>
            <?php endif; ?>
        </div>
    </main>
</body>
 
</html>