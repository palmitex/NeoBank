<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Carrega os saldos e investimentos a partir dos arquivos
$saldo = file_exists("saldo.txt") ? (float)file_get_contents("saldo.txt") : 0;
$investimento = file_exists("investimento.txt") ? (float)file_get_contents("investimento.txt") : 0;
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['investir'])) {
        $valorInvestimento = (float)$_POST['valorInvestimento'];

        // Verifica se o valor a ser investido é válido
        if ($valorInvestimento <= 0) {
            $erro = "O valor de investimento deve ser maior que zero.";
        } elseif ($valorInvestimento > $saldo) {
            $erro = "Saldo insuficiente na conta principal para o investimento.";
        } else {
            $investimento += $valorInvestimento;
            $saldo -= $valorInvestimento;

            // Atualiza os arquivos de saldo e investimento
            file_put_contents("saldo.txt", $saldo);
            file_put_contents("investimento.txt", $investimento);

            salvarTransacao("Investimento", $valorInvestimento);
            $erro = "Valor investido com sucesso!";
        }
    }

    if (isset($_POST['sacar_investimento'])) {
        $valorSaqueInvestimento = floatval($_POST['valorSaqueInvestimento']); // Garantindo que seja float

        // Debug: Mostra os valores carregados


        // Verifica se o valor a ser sacado é válido
        if ($valorSaqueInvestimento <= 0) {
            $erro = "O valor de saque deve ser maior que zero.";
        } elseif ($valorSaqueInvestimento > $investimento) {
            $erro = "Saldo de investimento insuficiente. Você pode sacar até R$ " . number_format($investimento, 2, ',', '.') . ".";
        } else {
            // Deduz o valor de saque do investimento
            $investimento -= $valorSaqueInvestimento; // Reduz o investimento exatamente pelo valor sacado
            $saldo += $valorSaqueInvestimento; // Adiciona o valor de saque no saldo da conta principal

            // Atualiza os arquivos de saldo e investimento
            file_put_contents("investimento.txt", $investimento);
            file_put_contents("saldo.txt", $saldo);

            salvarTransacao("Saque de Investimento", $valorSaqueInvestimento);
            $erro = "Saque do investimento realizado com sucesso!";
        }
    }
}

function salvarTransacao($tipo, $valor) {
    $data = date("Y-m-d H:i:s");
    $transacao = "$data - $tipo: R$" . number_format($valor, 2, ',', '.') . PHP_EOL;
    file_put_contents("historico.txt", $transacao, FILE_APPEND);
}

// Exibe erros de depuração no log do servidor
if ($erro) {
    error_log("Erro: $erro");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Investimento</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Investimento</h2>

    <p><strong>Saldo da Conta Principal:</strong> R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>
    <p><strong>Saldo de Investimento:</strong> R$ <span id="investmentBalance"><?php echo number_format($investimento, 2, ',', '.'); ?></span></p>

    <form method="POST">
        <label for="valorInvestimento">Valor para Investir:</label>
        <input type="number" name="valorInvestimento" placeholder="Valor para investir" step="0.01" >
        <button type="submit" name="investir">Investir</button>
    </form>

    <h3>Saque do Investimento para Conta Principal</h3>
    <form method="POST">
        <input type="number" name="valorSaqueInvestimento" placeholder="Valor para sacar" step="0.01">
        <button type="submit" name="sacar_investimento">Sacar Investimento</button>
    </form>

    <?php if (!empty($erro)): ?>
        <p id="mensagem"><?php echo $erro; ?></p>
    <?php endif; ?>

    <!-- Canvas do gráfico, apenas exibido se houver investimento -->
    <?php if ($investimento > 0): ?>
        <canvas id="investmentChart" width="100" height="50"></canvas>
    <?php else: ?>
        <p>Nenhum investimento feito. Realize um investimento para ver o gráfico.</p>
    <?php endif; ?>

    <script>
        let chart;
        let initialInvestment = <?php echo json_encode($investimento); ?>;
        let rate = 0.03; // taxa de crescimento
        let time = 0;

        function startChart() {
            const ctx = document.getElementById('investmentChart').getContext('2d');
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [time],
                    datasets: [{
                        label: 'Valor do Investimento',
                        data: [initialInvestment],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false,
                        tension: 0.4
                    }]
                },
                options: {
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuad'
                    },
                    scales: {
                        x: { title: { display: true, text: 'Tempo (s)' } },
                        y: { title: { display: true, text: 'Valor (R$)' } }
                    }
                }
            });

            setInterval(updateChart, 10000); // Atualiza o gráfico a cada 10 segundos
        }

        function updateChart() {
            time += 10;
            initialInvestment *= (1 + rate);

            chart.data.labels.push(time);
            chart.data.datasets[0].data.push(initialInvestment.toFixed(2));
            chart.update();

            document.getElementById("investmentBalance").innerText = initialInvestment.toFixed(2);

            // Salvar o investimento atualizado usando AJAX
            fetch('atualizar_investimento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ investimento: initialInvestment.toFixed(2) }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Sucesso:', data);
            })
            .catch((error) => {
                console.error('Erro:', error);
            });
        }

        // Começar a animação do gráfico somente se o investimento for maior que zero
        if (initialInvestment > 0) {
            window.onload = startChart;
        }
    </script>
</body>
</html>
