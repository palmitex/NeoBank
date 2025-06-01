<?php

// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

//array com porque
$porque = [
    [
        'titulo' => 'Solidez',
        'minitexto' => 'Os títulos do Tesouro Direto são produtos de renda fixa garantidos pelo Tesouro Nacional. Por isso são considerados investimentos seguros.'
    ],
    [
        'titulo' => 'Para todo mundo',
        'minitexto' => 'O Tesouro Direto tem títulos para diversos objetivos: reserva de emergência, proteção contra a inflação, renda passiva, aposentadoria, educação dos filhos e muito mais.'
    ],
    [
        'titulo' => 'Acessível',
        'minitexto' => 'É possível começar a investir no Tesouro Direto com pouco. Ao investir pelo NeoBank você não paga taxa de corretagem!'
    ]
];

//array com tipos
$tipos = [
    [
        'titu' => 'Tesouro Selic',
        'mini' => "Com rentabilidade atrelada à taxa básica de juros e liquidez diária, é uma boa opção para a reserva de emergência.",
        'taxa' => 13.75
    ],
    [
        'titu' => 'Tesouro IPCA+',
        'mini' => "Sua remuneração corresponde à variação do IPCA acrescida de uma taxa prefixada de juros, unindo rentabilidade e proteção contra a inflação. Indicado para objetivos de longo prazo, pode ser vendido antecipadamente (sujeito à marcação a mercado).",
        'taxa' => 6.50,
    ],
    [
        'titu' => 'Tesouro IPCA+ Juros Semestrais',
        'mini' => "Tem funcionamento semelhante ao IPCA+, só que com pagamento de juros semestrais diretamente na conta do investidor. Ideal para quem busca renda passiva.",
        'taxa' => 6.20,
    ],
    [
        'titu' => 'Tesouro Renda+',
        'mini' => "Voltado para quem busca um complemento para a aposentadoria no futuro, tem funcionamento semelhante ao de uma previdência privada. Após o período de acumulação, o investidor passa a receber um fluxo de pagamentos mensais durante 20 anos.",
        'taxa' => 5.50
    ],
    [
        'titu' => 'Tesouro Educa+',
        'mini' => 'Ideal para quem deseja se planejar para os gastos com a universidade, escola, cursinho e outras despesas dos filhos. Após o período de acumulação, o investidor passa a receber um fluxo de pagamentos mensais durante 5 anos.',
        'taxa' => 4.50
    ],
    [
        'titu' => 'Tesouro Prefixado',
        'mini' => 'Rentabilidade prefixada no momento do investimento. Ou seja, o investidor sabe exatamente o valor nominal que terá na data de vencimento. Pode ser uma boa opção em momentos de trajetória de queda na taxa básica de juros.',
        'taxa' => 7.50
    ],
];

// Mensagem da simulação
$mensagemSimulacao = '';

// Simulação de rendimento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simular'])) {
    $tipoSelecionado = isset($_POST['tipo_simulacao']) ? intval($_POST['tipo_simulacao']) : null;
    $valorInvestido = isset($_POST['valor_investido']) ? floatval($_POST['valor_investido']) : null;
    $anos = isset($_POST['anos']) ? intval($_POST['anos']) : null;

    // Verifica se todos os campos necessários foram preenchidos
    if ($tipoSelecionado !== null && $valorInvestido !== null && $anos !== null) {
        if (isset($tipos[$tipoSelecionado])) {
            $tipo = $tipos[$tipoSelecionado]['titu'];
            $taxaAnual = $tipos[$tipoSelecionado]['taxa'] / 100; // Convertendo para decimal
            $valorFinal = $valorInvestido * pow((1 + $taxaAnual), $anos); // Fórmula de juros compostos

            // Exibe a mensagem da simulação
            $mensagemSimulacao = "Investindo R$ " . number_format($valorInvestido, 2, ',', '.') .
                " no título " . htmlspecialchars($tipo) . " por $anos anos, você teria aproximadamente R$ " .
                number_format($valorFinal, 2, ',', '.') . ".";
        } else {
            $mensagemSimulacao = "Tipo de investimento inválido. Tente novamente.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tipos_investTESOURO.css">
    <link rel="stylesheet" href="../css/global.css">
    <title>Tesouro Direto - NeoBank</title>
    <script>
        // Função para mover o carrossel
        let currentIndex = 0;

        function moveCarousel(direction) {
            const container = document.querySelector('.carousel-container');
            const totalCards = document.querySelectorAll('.tipos').length;
            const cardWidth = document.querySelector('.tipos').offsetWidth + 50; // Incluindo margem e padding

            // Atualiza o índice com base na direção
            currentIndex += direction;

            // Impede que o carrossel vá além do primeiro ou terceiro card
            if (currentIndex < 0) currentIndex = 0; // Não permite ir para um índice negativo
            if (currentIndex >= 5) currentIndex = 4; // Impede que vá além do terceiro card (índice 2)

            // Calcula a nova posição para o container
            const newPosition = -currentIndex * cardWidth;
            container.style.transform = `translateX(${newPosition}px)`;
        }
    </script>
</head>

<body>
    <?php require_once 'navbar.php'; ?>
        <div class="container">
            <div class="banner">
                <div class="texto-banner">
                    <h3>Tesouro Direto</h3>
                    <h1>Construa um futuro financeiro sólido com investimentos seguros.</h1>
                    <p>O Tesouro Direto é a escolha ideal para quem busca estabilidade e rentabilidade. Invista com o NeoBank e alcance seus objetivos!</p>
                </div>
            </div>

    <main>
            <section class="porque">
                <h1>Porque investir em <span>Tesouro Direto?</span></h1>
                <h3 class="sub-title">O Tesouro Direto é um produto de investimento que oferece rentabilidade e segurança para seus investidores.</h3>
                <div class="features">
                    <?php
                    foreach ($porque as $pqs) {
                        echo "<div class='feature'>";
                        echo "<h3 class='feature-title'>" . htmlspecialchars($pqs['titulo']) . "</h3>";
                        echo "<p class='feature-description'>" . htmlspecialchars($pqs['minitexto']) . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </section>

            <h1>Conheça os títulos do Tesouro Direto</h1>
            <div class="carousel">
                <div class="carousel-container">
                    <?php
                    foreach ($tipos as $tesouro) {
                        echo "<div class='tipos'>";
                        echo "<h3>" . htmlspecialchars($tesouro['titu']) . "</h3>";
                        echo "<p>" . htmlspecialchars($tesouro['mini']) . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <!-- Navegação com ícones abaixo dos cards -->
            <div class="navigation">
                <i class="fas fa-chevron-left" onclick="moveCarousel(-1)"></i>
                <i class="fas fa-chevron-right" onclick="moveCarousel(1)"></i>
            </div>

            <!-- Simulação de Rendimento no Tesouro Direto -->
             <section class="container-tesouro">
            <div class="tesouro">
                <form method="POST" action="TesouroDireto.php">
                <h1>Simulação de Rendimento no Tesouro Direto</h1>

                    <label for="tipo_simulacao">Selecione o tipo de investimento:</label>
                    <select name="tipo_simulacao" id="tipo_simulacao" required>
                        <?php
                        foreach ($tipos as $index => $tesouro) {
                            echo "<option value='$index'>" . htmlspecialchars($tesouro['titu']) . "</option>";
                        }
                        ?>
                    </select>

                    <label for="valor_investido">Valor do Investimento Inicial (R$):</label>
                    <input type="number" name="valor_investido" id="valor_investido" step="0.01" min="0" required>

                    <label for="anos">Período de Investimento (anos):</label>
                    <input type="number" name="anos" id="anos" step="1" min="1" required>

                    <button type="submit" name="simular" class="button-saibamaisBranco">Simular rendimento</button>
                </form>
            </div>

                <!-- Resultado da Simulação -->
                <?php if (!empty($mensagemSimulacao)) : ?>
                    <div class="result">
                    <p><?php echo $mensagemSimulacao; ?></p>
                </div>
                <?php endif; ?>
            </section>
        </div>
    </main>
</body>
<?php require_once 'footer.php'; ?>

</html>