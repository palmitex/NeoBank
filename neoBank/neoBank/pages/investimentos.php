<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();

//array associativo das páginas e contatos da empresa e seus respectivos links
$sections = [
    [
        "icon" => 'taxa0-i.svg
',
        "title" => "Taxas Zero",
        "description" => "No NeoBank, você investe sem pagar corretagem ou custódia em produtos como CDBs, fundos, previdência, ações, ETFs e muito mais."
    ],
    [
        "icon" => 'transacoes-c-icon.svg
',
        "title" => "Gerencie pelo seu dispositivo",
        "description" => "Tenha acesso ao banco completo e à sua corretora de investimentos diretamente do seu dispositivo. Praticidade, segurança e controle total ao seu alcance."
    ],
    [
        "icon" => 'investimento-c-icon.svg
',
        "title" => "Ideal para todos os perfis",
        "description" => "Descubra carteiras recomendadas para seus objetivos ou personalize sua estratégia de investimentos com autonomia e eficiência."
    ]
];

$investimentos = [
    [
        "sub"=>"CDB",
        "texto"=>"Da liquidez Diária a longo prazo, com segurança, praticidade e proteção.",
        "link"=>"./CDB.php",
        "img"=>"https://storage.googleapis.com/a1aa/image/Aco0b0uFe4THcCZwAAZPIt9M52ejzDV3FWf2QwjdEOFkLeKPB.jpg"
    ],
    [
        "sub"=>"Tesouro Direto",
        "texto"=>"Investimento em títulos públicos, com baixo risco e rentabilidade definida: aposentadoria, acúmulo de patrimônio e etc.",
        "link"=>"./TesouroDireto.php",
        "img"=>"../img/Tesouro-Direto-Pix.webp"
    ],
    [
        "sub"=>"Previdência Privada",
        "texto"=>"Investimentos para planejar seu futuro ou manter sua qualidade de vida na aposentadoria.",
        "link"=>"./previdencia.php",
        "img"=>"../img/previdencia.webp"
    ],
    [
        "sub"=>"Mercados Futuros",
        "texto"=>"Operações para quem precisa de proteção ou busca oportunidades de lucro com a oscilação do mercado.",
        "link"=>"./MercadoFuturo.php",
        "img"=>"../img/mercado.webp"
    ],
   
    ];

    $blog=[
        [
            "img"=> "../img/rentabilidade.webp",
            "link"=>"#",
            "titulo"=> "Começando a invesitr: Guia Prático para Iniciantes",
            "texto"=> "Descubra os primeiros passos para começar a investir e garantir um futuro financeiro mais seguro, com estratégias simples e eficazes."

        ],
        [
            "img"=> "../img/investimento-2.webp",
            "link"=>"#",
            "titulo"=> "Conheça os Melhores Investimentos do NeoBank",
            "texto"=> "Explore as opções de CDB, Tesouro Direto, Mercados Futuros e mais, com as melhores oportunidades de crescimento no NeoBank"
        ],
        [
            "img"=> "../img/previdencia.jpeg",
            "link"=>"#",
            "titulo"=> "Aprenda Como Investir na Previdência Privada",
            "texto"=> "Aprenda a planejar o futuro com o NeoBank, investindo na Previdência Privada para multiplicar seu patrimônio com segurança."
        ]

];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/investimentos.css">
    <link rel="stylesheet" href="../css/global.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../media-query/media-query_investimentos.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>investimentos - NeoBank</title>
    <script>
        // Função para mover o carrossel
let currentIndex = 0;

function moveCarousel(direction) {
    const container = document.querySelector('.carousel-container');
    const totalCards = document.querySelectorAll('.tipos').length;
    const cardWidth = document.querySelector('.tipos').offsetWidth + 20; // Incluindo margem e padding

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
<body>
    <?php require_once 'navbar.php'; ?>
        <!-- Cabeçalho -->
        <div class="Titulo">
            <h1>Planeje seu futuro financeiro.<br>Invista pelo Neo<span>Bank</span>.</h1>
            <p>Transforme seu jeito de investir: tudo em um só app, de forma intuitiva e do seu jeito.</p>
        </div>
        <!--banner-->
        <div class="banner">
            <img src="../img/investimento-pagp.jpg">
        </div>        
        <main>

        <!--conteudo da pagina com foreach e carrossel-->
            <h2>Porque investir pelo Neo<span>Bank</span>?</h2>
        <div class="cards">
            <?php
                foreach ($sections as $section) {
                echo "<article>";
                echo "<div class='icon'><img src='../img/" . $section['icon'] . "'></div>";
                echo "<h3>{$section['title']}</h3>";
                echo "<p>{$section['description']}</p>";
                echo "</article>";
            }
            ?>
        </div>

        <h2>Plataformas de investimentos Neo<span>Bank</span></h2>

        <div class="investimentos">
            <p>Encontre uma ampla gama de opções de investimentos, desde iniciantes até investidores avançados,<br>e para todos os níveis de risco.</p>
        
        </div>

        <!-- Carrossel -->
        <div class="carousel">
        <div class="carousel-container">
            <?php
                foreach ($investimentos as $investimento) {
                    echo "<div class='tipos'>";
                    echo "<img src='{$investimento['img']}' alt='Imagem do produto financeiro'>";
                    echo "<div class='sub'>{$investimento['sub']}</div>";
                    echo "<p>{$investimento['texto']}</p>";
                    echo "<a href='{$investimento['link']}'><button class='btn'>Veja mais</button></a>";
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

        <!-- Conteúdo da seção imagem -->
    <section class="simu">
     <div class="left-section">
        <h3>Abra sua conta!</h3>
        <p>Caso não tenha criando sua conta ainda, clique aqui para abrir uma conta e invista com a NeoBank</p>
        <a  href="cadastro.php"><button class="button-saibamaisBranco">Abra sua conta<img src="../img/setaDiagonalBranco.png"></button></a>
    </div>
    <img alt="" class="simulator-image" src="../img/investimento-conta.jpg">
    </section>

    </main>
    <?php require_once 'footer.php'; ?>
</body>
</html>