<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();
//array de informações
$informacoes = [
    [
        "titulo" => "Segurança",
        "descricao" => "O CDB é um dos investimentos com risco mais baixo do mercado. E valores até R$ 250 mil são garantidos pelo FGC.",
        "icone" => 'seguranca-cdb.svg'
    ],
    [
        "titulo" => "Taxa zero",
        "descricao" => "O NeoBank não cobra nenhum tipo de taxa de custódia, administração ou qualquer outra tarifa. E é possível investir a partir de R$ 20.",
        "icone" => 'baixocusto-mcd-fut.svg'
    ],
    [
        "titulo" => "Prazos flexíveis",
        "descricao" => "De CDBs com liquidez diária até investimentos com vencimento em 7 anos, o NeoBank tem o produto perfeito para o seu planejamento financeiro.",
        "icone" => 'prazos-cdb.svg'
    ],
    [
        "titulo" => "Para todos os perfis",
        "descricao" => "Além dos CDBs pós-fixados e indexados ao CDI, no NeoBank você encontra produtos pré-fixados que garantem remuneração acima da inflação.",
        "icone" =>  'perfis-cdb.svg
'
    ]
];
// Array de CDBs
$cdbs = [
    ["nome" => "CDB NeoBank Pós-fixado Liquidez Diária", "rentabilidade" => "102.5% CDI", "resgate" => "Diário", "minimo" => "R$ 20,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank Garantia de Limite", "rentabilidade" => "100% CDI", "resgate" => "Diário", "minimo" => "R$ 100,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank Resgate Automático", "rentabilidade" => "100% CDI", "resgate" => "Diário", "minimo" => "R$ 50.000,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "Compromissada NeoBank Liquidez 250", "rentabilidade" => "75% CDI", "resgate" => "Diário", "minimo" => "R$ 250.000,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank Pós-fixado - 3 meses", "rentabilidade" => "103% CDI", "resgate" => "3 meses", "minimo" => "R$ 100,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank Pós-fixado - 6 meses", "rentabilidade" => "104% CDI", "resgate" => "6 meses", "minimo" => "R$ 100,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank Prefixado - 1 ano", "rentabilidade" => "13.6% a.a", "resgate" => "1 ano", "minimo" => "R$ 100,00", "risco" => "Nível 1", "fgc" => "Sim"],
    ["nome" => "CDB NeoBank IPCA+ Pós-fixado - 3 anos", "rentabilidade" => "IPCA + 7.2%", "resgate" => "3 anos", "minimo" => "R$ 100,00", "risco" => "Nível 1", "fgc" => "Sim"]
];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tipos_investCDB.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../media-query/media-query_CDB.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>CDB - NeoBank</title>
</head>

<body>
    <?php require_once 'navbar.php'; ?>

    <main>
        <!--conteudo da pagina-->
        <div class="container">
            <!--banner-->
            <div class="banner">
                <!--texto-banner-->
                <div class="texto-banner">
                    <h3>Renda fixa</h3>
                    <h1>Garanta segurança, estabilidade e proteção pelo FGC.</h1>
                    <p>No NeoBank, oferecemos opções de investimento em CDBs adaptadas a diferentes perfis e prazos.</p>
                </div>
            </div>
            <!--cards de informações com arrays e foreach-->
            <section class="porque">
                <div class="esquerda">
                    <h1>Por que investir em <span>Renda Fixa</span>?</h1>
                </div>
                <div class="direita">
                    <?php
                    foreach ($informacoes as $info) {
                        echo "<div class='card'>";
                        echo "<img class='icone' src ='../img/" . $info['icone'] . "'>";
                        echo "<h3>" . $info['titulo'] . "</h3>";
                        echo "<p>" . $info['descricao'] . "</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </section>
            <!--textos informacionais-->
            <div class="texto-ide">
                <div class="box-texto-ide">
                    <h1>Investimento perfeito para você</h1>
                    <p>O NeoBank oferece as melhores soluções do mercado para quem procura flexibilidade financeira ou deseja investir com foco em retornos a longo prazo.</p>
                    <a href="simuladorCDB.php"><button class="button-saibamaisBranco">Simule agora<img src="../img/setaDiagonalBranco.png"></button></a>
                </div>
                <img src="../img/investment-page.jpg" alt="" class="texto-ide-img">
            </div>
            <!--tabela dos CBDS-->
            <div class="tabela">
                <div class="tabela-container">
                    <h1>Encontre os melhores <span>CDBs</span></h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Rentabilidade</th>
                                <th>Resgate</th>
                                <th>Apl. Mínima</th>
                                <th>Risco</th>
                                <th>FGC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Gerar tabela dinamicamente
                            foreach ($cdbs as $cdb) {
                                echo "<tr>";
                                echo "<td>{$cdb['nome']}</td>";
                                echo "<td>{$cdb['rentabilidade']}</td>";
                                echo "<td>{$cdb['resgate']}</td>";
                                echo "<td>{$cdb['minimo']}</td>";
                                echo "<td>{$cdb['risco']}</td>";
                                echo "<td class='fgc'>{$cdb['fgc']}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                    <div class="botao-invest">
                        <h2>Aplique o seu dinheiro</h2>
                        <a href="investimentoCDB.php"><button class="button-saibamais">Invista agora<img src="../img/setaDiagonal.png"></button></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<?php require_once 'footer.php'; ?>

</html>