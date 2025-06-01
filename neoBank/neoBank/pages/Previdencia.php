<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

$features = [
    [
        "icon" => 'facilidade-mcd-fut.svg',
        "title" => "Praticidade para investir",
        "description" => "Faça investimentos mensais automáticos e construa seu patrimônio pouco a pouco, sem complicações."
    ],
    [
        "icon" => 'cashback.svg',
        "title" => "Sucessão simplificada",
        "description" => "Tenha uma reserva financeira para cuidar de sua família e beneficiários sem se preocupar com inventários ou custos legais de transferência de bens."
    ],
    [
        "icon" => 'setaBaixo.svg',
        "title" => "Menos impostos",
        "description" => "Se você costuma optar pela declaração completa do Imposto de Renda, a previdência privada pode proporcionar benefícios fiscais."
    ],
];

$erro = '';
$resultado = '';
$rendimentoAutomático = 6; // Rendimento padrão (moderado)

// Valores persistidos após o envio do formulário
$idadeAtual = isset($_POST['idade-atual']) ? (int) $_POST['idade-atual'] : 0;
$idadeAposentadoria = isset($_POST['idade-aposentadoria']) ? (int) $_POST['idade-aposentadoria'] : 0;
$valorDesejado = isset($_POST['valor-desejado']) ? (float) $_POST['valor-desejado'] : 0; // Valor desejado por mês na aposentadoria
$valorInicial = isset($_POST['valor-inicial']) ? (float) $_POST['valor-inicial'] : 0;
$perfilInvestimento = isset($_POST['perfil-investimento']) ? $_POST['perfil-investimento'] : 'moderado';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Definindo o rendimento anual conforme o perfil
    switch ($perfilInvestimento) {
        case 'conservador':
            $rendimentoAutomático = 4; 
            break;
        case 'arrojado':
            $rendimentoAutomático = 10; 
            break;
        case 'moderado':
        default:
            $rendimentoAutomático = 6; 
            break;
    }

    $rendimento = $rendimentoAutomático; 

    // Valida os dados
    if ($idadeAposentadoria <= $idadeAtual) {
        $erro = 'A idade de aposentadoria deve ser maior que a idade atual.';
    } elseif ($valorDesejado <= 0) {
        $erro = 'O valor desejado na aposentadoria deve ser maior que 0.';
    } else {
        // Cálculo do número de meses até a aposentadoria
        $anosInvestimento = $idadeAposentadoria - $idadeAtual;
        $numeroMeses = $anosInvestimento * 12;

        // Calculando o rendimento mensal
        $rendimentoMensal = $rendimento / 100 / 12;

        // Cálculo do valor necessário para garantir o valor desejado por mês durante a aposentadoria
        $valorNecessarioParaAposentadoria = $valorDesejado * ((1 - pow(1 + $rendimentoMensal, -$numeroMeses)) / $rendimentoMensal);

        // Fórmula para calcular o valor que precisa ser investido mensalmente
        // Fórmula do valor futuro de uma série de pagamentos (PMT = FV * r / ((1 + r)^n - 1))
        $valorNecessarioMensal = $valorNecessarioParaAposentadoria * $rendimentoMensal / (pow(1 + $rendimentoMensal, $numeroMeses) - 1);

        // Arredondar para 2 casas decimais nos resultados
        $valorNecessarioParaAposentadoria = round($valorNecessarioParaAposentadoria, 2);
        $valorNecessarioMensal = round($valorNecessarioMensal, 2);

        // Exibindo os resultados
        $resultado = "Com o perfil <strong>" . ucfirst($perfilInvestimento) . "</strong>, para garantir R$ " . number_format($valorDesejado, 2, ',', '.') . " por mês na aposentadoria:<br>";
        $resultado .= "Você precisa investir mensalmente R$ " . number_format($valorNecessarioMensal, 2, ',', '.') . " e acumulará R$ " . number_format($valorNecessarioParaAposentadoria, 2, ',', '.') . " até a aposentadoria.";
    }
}

// Array completo de previdências
$previdencias = [
    [
        "nome" => "Absolute Atenas Icatu Prev FIC de FI RF Créd Priv",
        "categoria" => "Renda Fixa Previdenciário",
        "rent_mensal" => "0,38%",
        "rent_anual" => "11,47%",
        "aporte_inicial" => "R$ 3.000,00",
        "aporte_adicional" => "R$ 500,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "0,98%"
    ],
    [
        "nome" => "Absolute Icatu I Prev FIC FI MM",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "1,04%",
        "rent_anual" => "8,91%",
        "aporte_inicial" => "R$ 5.000,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,95%"
    ],
    [
        "nome" => "Adam Icatu Previdenciário FICFI MM",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "1,06%",
        "rent_anual" => "13,79%",
        "aporte_inicial" => "R$ 1.500,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "2,00%"
    ],
    [
        "nome" => "Alaska 70 Icatu Previdenciário FI MM",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "-0,72%",
        "rent_anual" => "-10,80%",
        "aporte_inicial" => "R$ 1.500,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,50%"
    ],
    [
        "nome" => "APEX Long Biased Icatu Prev Fim 49",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "-0,10%",
        "rent_anual" => "-2,19%",
        "aporte_inicial" => "R$ 1.500,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,10%"
    ],
    [
        "nome" => "Apex Long Biased Icatu Previdenciário FIM 70",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "-0,27%",
        "rent_anual" => "-3,79%",
        "aporte_inicial" => "R$ 3.000,00",
        "aporte_adicional" => "R$ 500,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,80%"
    ],
    [
        "nome" => "ARX Denali Icatu Prev FIC FI RF CP",
        "categoria" => "Renda Fixa Previdenciário",
        "rent_mensal" => "0,37%",
        "rent_anual" => "10,33%",
        "aporte_inicial" => "R$ 3.000,00",
        "aporte_adicional" => "R$ 500,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,00%"
    ],
    [
        "nome" => "Arx Income Icatu Prev FI MM",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "-1,05%",
        "rent_anual" => "3,16%",
        "aporte_inicial" => "R$ 1.500,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,90%"
    ],
    [
        "nome" => "Arx Target Icatu Prev FICFI MM",
        "categoria" => "Multimercado Previdenciário",
        "rent_mensal" => "0,29%",
        "rent_anual" => "6,58%",
        "aporte_inicial" => "R$ 1.500,00",
        "aporte_adicional" => "R$ 300,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,30%"
    ],
    [
        "nome" => "Atena Icatu Prev FIC de FI Renda Fixa",
        "categoria" => "Renda Fixa Previdenciário",
        "rent_mensal" => "0,37%",
        "rent_anual" => "9,42%",
        "aporte_inicial" => "R$ 3.000,00",
        "aporte_adicional" => "R$ 500,00",
        "nivel_risco" => "Nível 2",
        "taxa_admin" => "1,10%"
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tipos_investPREVIDENCIA.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Previdencia - NeoBank</title>
</head>
<?php require_once 'navbar.php'; ?>
<body>
<main>
    <div class="container-prev">
        <div class="banner">
            <div class="texto-banner">
                <h3>Previdência Privada</h3>
                <h1>Segurança e conforto para você e sua família no futuro.</h1>
                <p>Planeje sua independência financeira. Invista em previdência privada com o NeoBank.</p>
            </div>
        </div>

        <section class="porque">
            <h1>Por que investir em <span>Previdência Privada?</span></h1>
            <h3 class="sub-title">Com a previdência privada você consegue manter sua qualidade de vida na aposentadoria sem precisar abrir mão do que gosta hoje.</h3>
            <div class="features">
                <?php
                foreach ($features as $feature) {
                    echo "<div class='feature'>";
                    echo "<img class='icone' src='../img/" . $feature['icon'] . "'>";
                    echo "<h3 class='feature-title'>" . htmlspecialchars($feature['title']) . "</h3>";
                    echo "<p class='feature-description'>" . htmlspecialchars($feature['description']) . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>

        <section class="simulador">
            <h1>Simule sua <span>previdência privada</span></h1>
            <!-- Formulário para calculo de simulação -->
            <div class="form-container">
            <form method="POST">
                <label for="idade-atual">Idade Atual:</label>
                <input type="number" id="idade-atual" name="idade-atual" value="<?= $idadeAtual ?>" required>

                <label for="idade-aposentadoria">Idade de Aposentadoria:</label>
                <input type="number" id="idade-aposentadoria" name="idade-aposentadoria" value="<?= $idadeAposentadoria ?>" required>

                <label for="valor-desejado">Valor Desejado por Mês:</label>
                <input type="number" id="valor-desejado" name="valor-desejado" value="<?= $valorDesejado ?>" required>

                <label for="valor-inicial">Valor Inicial (opcional):</label>
                <input type="number" id="valor-inicial" name="valor-inicial" value="<?= $valorInicial ?>">

                <label for="perfil-investimento">Perfil de Investimento:</label>
                <select id="perfil-investimento" name="perfil-investimento" required>
                    <option value="conservador" <?= $perfilInvestimento == 'conservador' ? 'selected' : '' ?>>Conservador</option>
                    <option value="moderado" <?= $perfilInvestimento == 'moderado' ? 'selected' : '' ?>>Moderado</option>
                    <option value="arrojado" <?= $perfilInvestimento == 'arrojado' ? 'selected' : '' ?>>Arrojado</option>
                </select>

                <button type="submit" class="btn-azul">Simular</button>
            </form>

             <!-- Resultado -->
        <div class="result">
            <p><?= $resultado ?></p>
        </div>
        
        <!-- Mensagem de erro -->
        <div class="erro">
            <p><?= $erro ?></p>
        </div>
    
        </section>
<!--  tabela de Previdências -->
<section class="previdencias">
    <div class="container-previdencias scroll-x">
        <h1> Conheça os nossos <span>produtos</span></h1>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Rent. Mês</th>
                        <th>Rent. Ano</th>
                        <th>Aporte Único</th>
                        <th>Aporte mensal</th>
                        <th>Risco</th>
                        <th>Taxa ADM.Ano</th>
                    </tr>
                </thead>
                <tbody>                       
                <?php      
                foreach ($previdencias as $fundo) {
                    echo "<tr>
                            <td>{$fundo['nome']}</td>
                            <td>{$fundo['categoria']}</td>
                            <td>{$fundo['rent_mensal']}</td>
                            <td>{$fundo['rent_anual']}</td>
                            <td>{$fundo['aporte_inicial']}</td>
                            <td>{$fundo['aporte_adicional']}</td>
                            <td>{$fundo['nivel_risco']}</td>
                            <td>{$fundo['taxa_admin']}</td>
                        </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

    </div>
</main>
</body>

<?php require_once 'footer.php'; ?>
</html>
