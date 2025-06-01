<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);

session_start();

// Array com os motivos
$motivos = [
    [
        'titulo'=>'Taxas de juros competitivas:',
        'text'=>"Oferecemos taxas de juros acessíveis, com total transparência, sem surpresas.",
    ],
    [
        'titulo'=>'Facilidade na aprovação:',
        'text'=>"Aprovamos seu crédito rapidamente, sem burocracia e com uma análise simples.",
    ],
    [
        'titulo'=>"Crédito adaptado para você:",
        'text'=> "Nosso sistema de empréstimos é flexível, com prazos e valores ajustados de acordo com suas necessidades.",
    ],
    [
        'titulo'=>"Segurança em primeiro lugar:",
        'text'=> "Com o NeoBank, você tem a certeza de que seus dados estão protegidos por sistemas de segurança de ponta.",
    ],
    [
        'titulo'=>"Suporte personalizado:",
        'text'=> "Nossa equipe está sempre pronta para oferecer suporte, ajudando vocé a escolher a melhor opção de crédito para o seu perfil.",
    ],
    [
        'titulo'=>"Sem taxas escondidas:",
        'text'=>"No NeoBank, a transparência é fundamental. Não cobramos taxas surpresa, você sabe exatamente o que está pagando.",
    ]
];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/emp.css">
    <link rel="stylesheet" href="../media-query/media-query_emprestimopage.css">
    <link rel="stylesheet" href="../css/global.css">
    <title>Emprestimos</title>
    <script>
    let currentIndex = 0;

    function moveCarousel(direction) {
    const container = document.querySelector('.carousel-container');
    const totalCards = document.querySelectorAll('.tipos').length;
    const cardWidth = document.querySelector('.tipos').offsetWidth + 50; // Incluindo margem e padding

    // Atualiza o índice com base na direção
    currentIndex += direction;

    if (currentIndex < 0) currentIndex = 0; // Não permite ir para um índice negativo
    if (currentIndex >= 5) currentIndex = 4;

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
            <h1>Crédito para organizar as finanças e manter as contas em dia</h1>
            <p>Descomplicado e transparente, opções de acordo com seus objetivos.</p>
        </div>
        <!-- Banner -->
        <div class="banner">
            <img src="../img/banner_emprestimo.jpeg" alt="logo">
        </div>

    <main>

        <div class="motivos">
            <h2>Por que fazer um empréstimo com o Neo<span>Bank</span>?</h2>
        </div>
        <!-- Carrossel -->
        <div class="carousel">
        <div class="carousel-container">
            <?php
            foreach ($motivos as $movitvo) {
                echo "<div class='tipos'>";
                echo "<h3>" . $movitvo['titulo'] . "</h3>";
                echo "<p>" . $movitvo['text'] . "</p>";
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

        <!-- Secção da página sobre criar conta -->
        <section class="Ctn">
            <!-- Conteúdo da seção texto e link -->
        <div class="left-section">
             <h3>Pronto para dar o próximo passo em direção ao seu empréstimo?</h3>
            <p>Com o NeoBank, você pode realizar seus projetos e resolver suas pendências financeiras de maneira simples e segura. Não perca tempo, faça seu emprestimo agora mesmo!</p>
            <a href="emprestimo.php" style="text-decoration: none;"><button class="button-saibamaisBranco">Solicitar Empréstimo<img src="../img/setaDiagonalBranco.png"></button></a>
           </div>
           <!-- Conteúdo da seção imagem -->
            <img  class="simulator-image" src="../img/pessoa_emprestimos.jpeg">
        </section>
    </main>
</body>

<?php require_once 'footer.php'; ?>
</html>