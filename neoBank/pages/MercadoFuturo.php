<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();
//array com os tipos de investimentos
$porque=[
    [
        "icon"=> 'baixocusto-mcd-fut.svg',
        "titulo"=>'Baixo custo',
        "minitexto"=>'Economize mais, invista melhor. Sem taxas ocultas, só resultados.',
    ],
    [
        "icon"=> 'facilidade-mcd-fut.svg',
        "titulo"=>'Facilidade',
        "minitexto"=>'Gerencie seus investimentos com um clique, direto do seu navegador.',
    ],
    [
        "icon"=> 'diversificacao-mcd-fut.svg',
        "titulo"=>'Diversificação',
        "minitexto"=>'Opções variadas para todos os perfis de investidores, do conservador ao arrojado.',
    ],
    [
        "icon"=> 'alavancagem-mcd-fut.svg',
        "titulo"=>'Alavancagem',
        "minitexto"=>'Potencialize seus ganhos investindo mais com menos capital inicial.',
    ]
    ];

    //array com os contratos
    $precisa = [
        [
            "title"=> 'O que é Mercado Futuro?',
            "text"=> 'O Mercado Futuro no NeoBank permite que você compre ou venda determinados ativos em uma data futura por um preço previamente acordado. No NeoBank, você pode operar com contratos de dólar (DOL), mini dólar (WDO), contratos de índice cheio (IND) e mini índice (WIN). Verifique os ativos disponíveis diretamente em nossa plataforma digital.',
        ],
        [
            "title"=> 'O que são as garantias?',
            "text"=> 'Para operar no Mercado Futuro pelo NeoBank, você precisa comprovar que é capaz de cobrir possíveis prejuízos nas operações, alocando um valor como garantia financeira. Essas garantias são ajustadas diariamente e podem variar, conforme especificado em nossa plataforma. Todas as operações seguem as regras e padrões da B3.',
        ],
        [
            "title"=> 'Vencimentos',
            "text"=> 'No NeoBank, os contratos de índice possuem vencimentos a cada dois meses, enquanto os contratos de dólar têm vencimento mensal. Isso se aplica tanto a minicontratos quanto a contratos cheios, oferecendo flexibilidade e opções alinhadas ao seu perfil de investimento.',
        ]
            
        ];
        // Array com os contratos e seus códigos
        $contratos = [
            ["contrato" => "MINI ÍNDICE", "codigo" => "WIN"],
            ["contrato" => "MINI DÓLAR", "codigo" => "WDO"],
            ["contrato" => "ÍNDICE CHEIO", "codigo" => "IND"],
            ["contrato" => "DÓLAR CHEIO", "codigo" => "DOL"],
            ["contrato" => "CAFÉ", "codigo" => "CAF"],
            ["contrato" => "MILHO", "codigo" => "MIL"],
            ["contrato" => "BOI", "codigo" => "BOI"],
            ["contrato" => "PETRÓLEO", "codigo" => "PET"]
        ];        
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tipo_investMERCADOFUT.css">
    <link rel="stylesheet" href="../css/global.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../media-query/media-query_mercadofuturo.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Mercado Futuro - NeoBank</title>
    <script>
        // Função para mover o carrossel de cards
        let currentIndex = 0;

        function moveCarousel(direction) {
            const container = document.querySelector('.carousel-container'); // Seleciona o container do carrossel
            const totalCards = document.querySelectorAll('.tipos').length; // Total de cards no carrossel
            const cardWidth = document.querySelector('.tipos').offsetWidth + 50; // Largura de cada card incluindo margens

             // Atualiza o índice com base na direção
             currentIndex += direction;

            // Impede que o carrossel vá além do primeiro ou último card
            if (currentIndex < 0) currentIndex = 0; // Não permite ir para um índice negativo
            if (currentIndex >= totalCards - 1) currentIndex = totalCards - 1; // Não permite ultrapassar o número de cards

            // Calcula a nova posição para o container
            const newPosition = -currentIndex * cardWidth;
            container.style.transform = `translateX(${newPosition}px)`;
            }            
    </script>
</head>
<?php require_once 'navbar.php'; ?>
<body>
        <!-- Cabeçalho da página -->
         <div class="titulo">
        <h1>Negocie contratos de mercados futuros sem pagar corretagem.</h1>
        <p>Operações para quem precisa de proteção ou busca oportunidades de lucro com a oscilação do mercado</p>
         </div>
        <div class="banner">
        <img src="../img/bannerMERCADO.jpeg"> <!-- Banner principal da página -->
        </div>
    <main>

        <!-- Título "Porque operar pelo NeoBank?" -->
         <div class="motivos">
        <h2>Por que operar pelo Neo<span>Bank</span>?</h2>
    </div>

        <!-- Carrossel de cards -->
        <div class="carousel">
            <div class="carousel-container">
                <?php
                    // Loop PHP para gerar os cards a partir do array $porque
                    foreach ($porque as $pq) {
                        echo "<div class='tipos'>";
                        echo "<img class='icone' src='../img/" . $pq['icon'] . "'>";
                        echo "<h3>" . $pq['titulo'] . "</h3>";
                        echo "<p>" . $pq['minitexto'] . "</p>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>

        <!-- Navegação com ícones para mover o carrossel -->
        <div class="navigation">
            <i class="fas fa-chevron-left" onclick="moveCarousel(-1)"></i> <!-- Ícone para mover para a esquerda -->
            <i class="fas fa-chevron-right" onclick="moveCarousel(1)"></i> <!-- Ícone para mover para a direita -->
        </div>

        <!-- Seção explicativa sobre o nível de risco -->
        <section class="risco">
            <div class="lado_esquerdo">
                <h3>Nivel de Risco</h3>
                <p>Operações no mercado futuro maximizam as oportunidades de ganho, mas também trazem riscos elevados para o investidor. Produto recomendado exclusivamente para investidores experientes e com perfil agressivo de risco.</p>
            </div>
                <img alt="" class="image" src="../img/2-columns-desk-60-2.webp" class="image"> <!-- Imagem ilustrativa -->
        </section>

        <!-- Seção de conteúdo explicativo sobre o que o usuário precisa saber -->
        <section class="Precisar">
            <h1>O que você precisar saber?</h1>
            <div class="conteudo">
                <?php
                // Loop PHP para exibir informações adicionais
                foreach ($precisa as $precisar) {
                    echo "<div class='Precisa'>";
                    echo "<h3>" . $precisar['title'] . "</h3>";
                    echo "<p>" . $precisar['text'] . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
            
            <!-- Informações sobre garantias financeiras -->
            <h1>Saiba sobre as garantias financeiras</h1>
            <p class="garantia">A garantia financeira pode ser ajustada conforme a variação da posição aberta nos contratos futuros...</p>

            <!-- Explicação sobre como descobrir o código do contrato -->
            <h1>Como descubro o código do contrato?</h1>
            <p class="garantia">As três primeiras letras se referem ao tipo de ativo. A letra seguinte diz respeito ao mês de vencimento...</p>
        </section>

        <!-- Tabela com informações dos contratos -->
        <div class="tabela">
            <table>
                <thead>
                    <tr>
                        <th>Contrato</th>
                        <th>Código de Negociação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Loop PHP para gerar as linhas da tabela a partir do array $contratos
                    foreach ($contratos as $contrato): ?>
                        <tr>
                            <td><?= $contrato["contrato"]; ?></td>
                            <td><?= $contrato["codigo"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Link para a página de investimentos -->
        <a href="MercadoFuturoINVE.php"><button class="button-saibamais">Simule agora<img src="../img/setaDiagonal.png"></button></a>
    </main>
</body>

<?php require_once 'footer.php'; ?>
</html>