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
 
// Carrega o saldo e o CPF do usuário
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
    // Substitui vírgulas por pontos, caso necessário
    $valorPagamento = str_replace(',', '.', $_POST['valor']);
    $valorPagamento = floatval($valorPagamento); // Converte para número decimal
    $senha = $_POST['senha'];
 
    // Carrega a senha do arquivo de usuários
    $senhaArquivo = carregarSenha($cpf);
 
    // Valida o pagamento
    if ($valorPagamento <= 0) {
        $erro = "Valor de pagamento inválido.";
    } elseif ($valorPagamento > $saldo) {
        $erro = "Saldo insuficiente.";
    } elseif ($senha !== $senhaArquivo) {  // Comparando a senha com a do arquivo
        $erro = "Senha incorreta.";
    } else {
        // Atualiza o saldo e salva a transação
        $saldo -= $valorPagamento;
        file_put_contents($saldoArquivo, $saldo);
        salvarTransacao("Transferência", $valorPagamento);
        $erro = "Transferência realizada com sucesso!";
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
    <title>Transferências - NeoBank</title>
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
 
    <script>
        // Função para alternar visibilidade do saldo
        function toggleSaldo() {
            const saldoElement = document.getElementById("saldo");
            const eyeIcon = document.getElementById("eyeIcon");
 
            // Alterna visibilidade do saldo
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
                // Converte o valor selecionado para o formato correto (com ponto)
                const valorFinal = (parseInt(valorSelecionado, 10) || 0) / 100;
                document.getElementById("valor").value = valorFinal.toFixed(2); // Atualiza o campo oculto
 
                // Esconde o teclado e exibe o campo de senha
                document.getElementById("campo-valor").style.display = "none";
                document.getElementById("campo-senha").style.display = "block";
            }
        }
        function confirmarChave() {
    const chaveCampo = document.getElementById("campo-chave");
    const valorCampo = document.getElementById("campo-valor");
 
    // Verifica se o campo chave não está vazio
    if (document.getElementById("chave").value !== "") {
        chaveCampo.style.display = "none";  // Esconde o campo chave
        valorCampo.style.display = "block";  // Exibe o campo de valor
    } else {
        alert("Por favor, insira uma chave válida.");
    }
}
    </script>
</head>
 
<body>
    <main>
 
        <button onclick="goBack()" class="button-saibamais"><img src="../img/arrow-left.svg">Voltar</button>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
       
        <section>
            <div class="container">
                <h1>Transferir</h1>
                <p>Saldo Atual: R$ <span id="saldo"><?php echo number_format((float)$saldo, 2, ',', '.'); ?></span>
                    <img id="eyeIcon" src="../img/eye.svg" alt="Mostrar Saldo" class="eye-icon" onclick="toggleSaldo()" style="width: 30px; height: 30px; cursor: pointer; vertical-align: middle;">
                </p>
 
                <!-- Campo de chave -->
                 <div id="campo-chave">
                     <input type="text" id="chave" name="chave" placeholder="Digite a chave" required><br><br>
                     <label for="chave">Celular, CPF, CNPJ, E-mail, Chave Aleatória ou Pix Copia e Cola</label><br><br>
                     <button type="button" onclick="confirmarChave()" class="btn-azul">Confirmar Chave</button>
                 </div>
 
                 <!-- Campo de valor de transferência -->
                 <div id="campo-valor" style="display: none;">
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
                        <button type="submit" class="btn-azul">Confirmar Transferência</button>
                    </div>
                </form>
 
                <?php if ($erro): ?>
                    <p class="erro"><?php echo $erro; ?></p>
                <?php endif; ?>
 
            </div>
        </section>
    </main>
</body>
 
</html>