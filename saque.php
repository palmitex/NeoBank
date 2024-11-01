<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$saldo = file_exists("saldo.txt") ? file_get_contents("saldo.txt") : 0;
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valorSaque = (float) $_POST['valor'];
    $senha = $_POST['senha'];

    if ($valorSaque <= 0) {
        $erro = "Valor de saque inválido.";
    } elseif ($valorSaque > $saldo) {
        $erro = "Saldo insuficiente.";
    } elseif ($senha !== $_SESSION['senha']) {
        $erro = "Senha incorreta.";
    } else {
        $saldo -= $valorSaque;
        file_put_contents("saldo.txt", $saldo);
        salvarTransacao("Saque", $valorSaque);
        $erro = "Saque realizado com sucesso!";
    }
}

// Exemplo de como salvar uma transação ao final de uma operação
function salvarTransacao($tipo, $valor) {
    $data = date("Y-m-d H:i:s");
    $transacao = "$data - $tipo: R$" . number_format($valor, 2, ',', '.') . PHP_EOL;
    file_put_contents("historico.txt", $transacao, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Saque</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function toggleSaldo() {
            const saldoElement = document.getElementById("saldo");
            const eyeIcon = document.getElementById("eyeIcon");
            
            if (saldoElement.textContent === "••••••") {
                saldoElement.textContent = "<?php echo number_format((float)$saldo, 2, ',', '.'); ?>";
                eyeIcon.src = "svg/eye-slash.svg"; // Ícone de olho com barra
                eyeIcon.alt = "Ocultar Saldo";
            } else {
                saldoElement.textContent = "••••••";
                eyeIcon.src = "svg/eye.svg"; // Ícone de olho sem barra
                eyeIcon.alt = "Mostrar Saldo";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Saque</h1>
        <p>Saldo Atual: R$ <span id="saldo"><?php echo number_format($saldo, 2, ',', '.'); ?></span> 
            <img id="eyeIcon" src="svg/eye.svg" alt="Mostrar Saldo" class="eye-icon" onclick="toggleSaldo()" style="width: 30px; height: 30px; cursor: pointer; margin-left: 10px; margin-right: 10px; vertical-align: middle;"></p>

        <form method="post">
            <label for="valor">Valor do Saque:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>

            <label for="senha">Confirme sua Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="button">Confirmar Saque</button>
        </form>

        <?php if ($erro): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <a href="index.php" class="button">Voltar ao Menu Principal</a>
    </div>
</body>
</html>
