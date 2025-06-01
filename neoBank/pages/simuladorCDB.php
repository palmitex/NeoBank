<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

require 'array_CDB.php';

// Inicializando variáveis
$mensagemSimulacao = $erro = ''; 

// Verificar se foi submetido um formulário para a simulação
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simular'])) {
    $produtoIndex = intval($_POST['produto']);
    $valorInvestido = floatval($_POST['valor_investido']);
    $tempoMeses = intval($_POST['tempo_meses']);
    $produto = $produtos[$produtoIndex];

    // Verificar se a chave 'taxa_juros' existe no produto
    if (!isset($produto['taxa_juros'])) {
        $erro = "Taxa de juros não encontrada para o produto selecionado.";
    } elseif ($valorInvestido < $produto['aplicacao_minima']) {
        $erro = "O valor mínimo para este investimento é R$ " . number_format($produto['aplicacao_minima'], 2, ',', '.');
    } elseif ($valorInvestido <= 0 || $tempoMeses <= 0) {
        $erro = "Insira valores válidos para o investimento e o tempo.";
    } else {
        // Calcular o rendimento da simulação
        $taxaAnual = floatval($produto['taxa_juros']);
        $taxaMensal = pow(1 + $taxaAnual, 1 / 12) - 1;
        $rendimento = $valorInvestido * pow(1 + $taxaMensal, $tempoMeses);

        // Exibir os resultados da simulação
        $mensagemSimulacao = "Investimento de R$ " . number_format($valorInvestido, 2, ',', '.') . 
                             " aplicado por $tempoMeses meses renderá R$ " . number_format($rendimento, 2, ',', '.') . ".";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/simuladorCDB.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">

    <title>Simulador CDB - NeoBank</title>
</head>
<body>

    <main>
    <h1>Simule agora!</h1>
        
        <!-- Formulário para simulação -->
        <section class="formulario-simulacao">
            <form method="POST">
                <label for="produto">Escolha o produto:</label>
                <select name="produto" id="produto" aria-label="Escolha um produto de investimento">
                    <?php foreach ($produtos as $index => $produto): ?>
                        <option value="<?= $index ?>"><?= $produto['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label for="valor_investido">Valor do investimento (R$):</label>
                <input type="number" name="valor_investido" id="valor_investido" step="0.01" required 
                aria-describedby="valor-invalido" placeholder="Informe o valor" min="0">
                <br>
                <label for="tempo_meses">Tempo do investimento (meses):</label>
                <input type="number" name="tempo_meses" id="tempo_meses" min="1" required 
                placeholder="Informe o número de meses">
                <br>
                <button type="submit" name="simular" class="btn-azul">Simular</button>
            </form>
            
            <div class="container-result">
                <div class="container-result-content">
                <h2>Resultado da Simulação</h2>
            <!-- Exibir a mensagem de erro ou de sucesso da simulação -->
            <?php if ($mensagemSimulacao): ?>
                <div class="resultado-simulacao">
                    <p><strong>Valor Investido:</strong> R$<?php echo number_format($valorInvestido, 2, ',', '.'); ?></p>
                    <p><strong>Tempo do Investimento:</strong> <?php echo $tempoMeses; ?> meses</p>
                    <p><strong>Taxa de Juros Anual:</strong> <?php echo number_format($taxaAnual * 100, 2, ',', '.'); ?>%</p>
                    <p><strong>Rendimento Final:</strong> R$<?php echo number_format($rendimento, 2, ',', '.'); ?></p>
            </div>
            </div>
            </div>
            <?php elseif ($erro): ?>
                <div class="erro">
                    <p><?php echo $erro; ?></p>
            </div>
            <?php endif; ?>
        </section>
    </main> 
</body>
</html>
