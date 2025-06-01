<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require 'array_CDB.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit;
}

// Carregar saldo e investimentos do usuário de acordo com seu CPF
$cpf = $_SESSION['cpf'];
$saldoPath = "saldos/saldo_$cpf.txt";
$investimentoPath = "investimentos/investimentos_$cpf.txt";

// Verifica saldo existente
$saldo = file_exists($saldoPath) ? floatval(file_get_contents($saldoPath)) : 0.0;
$mensagem = $erro = '';

// Processar investimento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['investir'])) {
    $produtoIndex = intval($_POST['produto']);
    $valor = floatval($_POST['valor_investido']);
    $produto = $produtos[$produtoIndex];

    // Verificar se o valor do investimento é suficiente
    if ($valor > $saldo) {
        $erro = "Você não tem saldo suficiente para este investimento.";
    } elseif ($valor < $produto['aplicacao_minima']) {
        $erro = "O valor mínimo para este investimento é R$ " . number_format($produto['aplicacao_minima'], 2, ',', '.');
    } else {
        // Atualizar saldo após investimento
        $saldo -= $valor;
        file_put_contents($saldoPath, $saldo);

        // Registrar investimento
        $investimentos = file_exists($investimentoPath) ? json_decode(file_get_contents($investimentoPath), true) : [];
        
        if (!is_array($investimentos)) {
            $investimentos = [];  // Garantir que seja um array válido
        }

        $investimentos[] = [
            'nome' => $produto['nome'],
            'valor' => $valor,
            'data' => date("Y-m-d"),
            'status' => 'ativo',
            'taxa_juros' => $produto['taxa_juros'] // Salvar a taxa de juros do produto no investimento
        ];
        file_put_contents($investimentoPath, json_encode($investimentos));

        $mensagem = "Investimento realizado com sucesso!";
        // Redirecionar para evitar o reenvio do formulário ao recarregar a página
        header("Location: " . $_SERVER['PHP_SELF']);
        exit; // Garante que o código abaixo não será executado após o redirecionamento
    }
}

// Processar saque
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sacar'])) {
    $investimentoIndex = intval($_POST['investimento_id']);
    
    $investimentos = json_decode(file_get_contents($investimentoPath), true);

    if (isset($investimentos[$investimentoIndex])) {
        $valorSaque = $investimentos[$investimentoIndex]['valor'];
        $saldo += $valorSaque;
        file_put_contents($saldoPath, $saldo);
        
        // Marcar investimento como sacado
        $investimentos[$investimentoIndex]['status'] = 'sacado';
        file_put_contents($investimentoPath, json_encode($investimentos));

        $mensagem = "Saque de R$ " . number_format($valorSaque, 2, ',', '.') . " realizado com sucesso!";
    } else {
        $erro = "Investimento não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/investimentoCDB.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../media-query/media-query_investCDB.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Invista pelo NeoBank</title>
</head>
<body>
<h1>Realizar Investimento</h1>
    
    <!-- Exibição do saldo -->
    <p><strong>Saldo Atual:</strong> R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>
    <!-- Formulário de investimento -->

    <form method="POST" class="investimento-form">
        <label for="produto">Escolha o produto:</label>
        <select name="produto" id="produto">
            <?php foreach ($produtos as $index => $produto): ?>
                <option value="<?= $index ?>"><?= $produto['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="valor_investido">Valor do investimento:</label>
        <input type="number" name="valor_investido" step="0.01" required>
        <br>
        <button type="submit" name="investir" class="btn-azul">Investir</button>
    </form>

    <h2>Investimentos Ativos</h2>
    <?php
    $investimentos = file_exists($investimentoPath) ? json_decode(file_get_contents($investimentoPath), true) : [];
    if (!is_array($investimentos)) {
        $investimentos = [];  // Garantir que seja um array válido
    }
    // tabela de investimentos caso o usuário tenha algum
    if (count($investimentos) > 0) {
        echo "<table border='1'><tr><th>Produto</th><th>Valor</th><th>Taxa de Juros</th><th>Data</th><th>Ação</th></tr>";
        foreach ($investimentos as $index => $investimento) {
            if ($investimento['status'] == 'ativo') {
                echo "<tr>
                        <td>" . $investimento['nome'] . "</td>
                        <td>R$ " . number_format($investimento['valor'], 2, ',', '.') . "</td>
                        <td>" . number_format($investimento['taxa_juros'] * 100, 2, ',', '.') . "%</td>
                        <td>" . $investimento['data'] . "</td>
                        <td>
                            <form method='POST'>
                                <input type='hidden' name='investimento_id' value='$index'>
                                <button type='submit' name='sacar'>Sacar</button>
                            </form>
                        </td>
                    </tr>";
            }
        }
        echo "</table>";
    } else {
        echo "<p>Você não tem investimentos ativos.</p>";
    }
    ?>

    <p><?= $mensagem ?: $erro ?></p>
</body>
</html>
