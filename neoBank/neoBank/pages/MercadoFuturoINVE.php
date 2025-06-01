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
 
// Carrega o saldo do usuário de acordo com seu cpf
$cpf = $_SESSION['cpf'];
$saldoArquivo = "saldos/saldo_$cpf.txt";

// Função para carregar o saldo do usuário
function carregarSaldo($saldoArquivo)
{
    return file_exists($saldoArquivo) ? floatval(file_get_contents($saldoArquivo)) : 0;
}

// Função para calcular cenários de flutuação
function simularCenarios($valor, $variacoes)
{
    $resultados = [];
    foreach ($variacoes as $variacao) {
        // Adiciona o cenário de alta
        $resultados[] = [
            "cenario" => "Alta de " . ($variacao * 100) . "%",
            "var" => "+" . ($variacao * 100) . "%",
            "valor" => $valor * (1 + $variacao)
        ];
        // Adiciona o cenário de baixa
        $resultados[] = [
            "cenario" => "Baixa de " . ($variacao * 100) . "%",
            "var" => "-" . ($variacao * 100) . "%",
            "valor" => $valor * (1 - $variacao)
        ];
    }
    return $resultados;
}

// Saldo atual do usuário
$saldo = carregarSaldo($saldoArquivo);

// Tipos de contratos e preços
$contratos = [
    "DOL" => "Dólar Cheio",
    "WDO" => "Mini Dólar",
    "IND" => "Índice Cheio",
    "WIN" => "Mini Índice",
    "CAF" => "Café",
    "MIL" => "Milho",
    "BOI" => "Boi",
    "PET" => "Petróleo"
];

// Gerar preços aleatórios para cada contrato
$precosContratos = array_map(function () {
    return rand(500, 2000); // Preços entre R$500 e R$2000
}, $contratos);

// Taxas de variação de mercado
$variacoes = [0.05, 0.10, 0.20];

// Proteção contra reenvio de formulário
if (!isset($_SESSION['form_key'])) {
    $_SESSION['form_key'] = bin2hex(random_bytes(16));
}
$form_key = $_SESSION['form_key'];

// Variáveis de mensagens
$mensagem = '';
$erro = '';
$resultados = [];

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_key']) && $_POST['form_key'] === $form_key) {
    $_SESSION['form_key'] = bin2hex(random_bytes(16)); // Regenera o form_key

    // Dados do formulário
    $contratoSelecionado = htmlspecialchars($_POST['contrato']);
    $valorInvestido = floatval($_POST['valor']);

    if ($valorInvestido > $saldo) {
        $erro = "Saldo insuficiente para realizar a simulação.";
    } else {
        $resultados = simularCenarios($valorInvestido, $variacoes);
        $mensagem = "Simulação concluída para o contrato " . $contratos[$contratoSelecionado] . ". Confira os cenários abaixo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Mercado futuro</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f6fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            width: 100%;
            justify-items: center;
        }

        h1::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--Blue2);
            margin: 0 auto;
            position: absolute;
            border-radius: 10px;
        }

        .saldo {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .contract-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .contract {
            flex: 1 0 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-azul{
            width: 150px;
            height: 40px;
        }

        .results {
            margin-top: 20px;
        }

        .results table {
            width: 100%;
            border-collapse: collapse;
        }

        .results th,
        .results td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .results th {
            background-color: #007bff;
            color: #fff;
        }

        .message,
        .error {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .message {
            color: #28a745;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Cabeçalho da página com informações do usuário -->
         <div class="title">
        <h1>NeoBank Mercado Futuro</h1>
         </div>
        <p class="saldo">Saldo disponível: R$ <?= number_format($saldo, 2, ',', '.') ?></p>

        <!-- Botões de contratos -->
        <div class="contract-buttons">
            <?php foreach ($contratos as $codigo => $descricao): ?>
                <!-- Formulário de escolha de contrato -->
                <div class="contract">
                    <h3><?= $descricao ?> (<?= $codigo ?>)</h3>
                    <p>Valor inicial: R$ <?= number_format($precosContratos[$codigo], 2, ',', '.') ?></p>
                    <form method="POST">
                        <input type="hidden" name="form_key" value="<?= $form_key ?>">
                        <input type="hidden" name="contrato" value="<?= $codigo ?>">
                        <input type="hidden" name="valor" value="<?= $precosContratos[$codigo] ?>">
                        <button type="submit" class="btn-azul">Escolher</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Resultados da simulação em formatto de tabela-->
        <?php if ($resultados): ?>
            <div class="results">
                <h2>Resultados da Simulação</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Cenário</th>
                            <th>Variação</th>
                            <th>Valor Final (R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>
                                <td><?= $resultado['cenario'] ?></td>
                                <td><?= $resultado['var'] ?></td>
                                <td><?= number_format($resultado['valor'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mensagem de sucesso ou erro -->
        <?php endif; ?>
        <?php if ($erro): ?>
            <p class="error"><?= $erro ?></p>
        <?php elseif ($mensagem): ?>
            <p class="message"><?= $mensagem ?></p>
        <?php endif; ?>
    </div>
</body>

</html>