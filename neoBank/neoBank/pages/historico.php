<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Carrega o histórico de transações e carrega seu cpf
$cpf = $_SESSION['cpf'];
$historicoArquivo = "historico/historico_$cpf.txt";

// Lê o histórico de transações
$historico = file_exists($historicoArquivo) ? file($historicoArquivo) : [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Transações - NeoBank</title>
    <link rel="stylesheet" href="../css/historico.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../media-query/media-query_historico.css">
</head>
<body>
    <main class="container-hist">
        <div class="container-title">
        <h1>Histórico de Transações</h1>
        </div>
        <!-- Tabela de transações -->
        <?php if (!empty($historico)): ?>
            <table class="historico-tabela">
                <thead>
                    <tr>
                        <th>Data e Hora</th>
                        <th>Tipo de Operação</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historico as $transacao): ?>
                        <?php
                        // Separando os componentes da transação
                        $partesTransacao = explode(" - ", $transacao);
                        if (count($partesTransacao) === 2) {
                            list($dataHora, $tipoValor) = $partesTransacao;
                            $tipoValorPartes = explode(": ", $tipoValor);

                            // Verificação para formatar o valor
                            if (count($tipoValorPartes) === 2) {
                                list($tipo, $valor) = $tipoValorPartes;

                                // Remover 'R$', remover pontos (separadores de milhar) e ajustar a vírgula para ponto
                                $valor = str_replace("R$", "", $valor);
                                $valor = str_replace(".", "", $valor); // Remove os pontos dos milhares
                                $valor = str_replace(",", ".", $valor); // Substitui vírgula por ponto
                                $valor = floatval($valor); // Converte para número float

                                // Formatando para moeda brasileira
                                $valorFormatado = "R$ " . number_format($valor, 2, ',', '.');
                            } else {
                                $tipo = "Desconhecido";
                                $valorFormatado = "Formato Inválido";
                            }
                            // Fim da verificação
                        } else {
                            $dataHora = "Desconhecida";
                            $tipo = "Desconhecido";
                            $valorFormatado = "Formato Inválido";
                        }
                        ?>
                        <!-- Linha da tabela -->
                        <tr>
                            <td><?php echo htmlspecialchars($dataHora); ?></td>
                            <td><?php echo htmlspecialchars($tipo); ?></td>
                            <td><?php echo htmlspecialchars($valorFormatado); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Mensagens de verificação -->
        <?php else: ?>
            <p class="no-transacoes">Não há transações registradas.</p>
        <?php endif; ?>

        <a href="index.php"><button class="btn-azul">Voltar ao menu principal</button></a>
        </main>
</body>
</html> 