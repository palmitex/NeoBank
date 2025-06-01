<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start();
/* array associativo dos cards do "Acesso Rápido" */
$cards = [
    [
        'icone' => 'cliente-icon.svg',
        'nome' => 'Transferência',
        'link' => 'pagamento.php'
    ],
    [
        'icone' => 'transacoes-c-icon.svg',
        'nome' => 'Empréstimo',
        'link' => 'emprestimo.php'
    ],

    [
        'icone' => 'qualquer-icon.svg',
        'nome' => 'Depósito',
        'link' => 'deposito.php'
    ],
    [
        'icone' => 'investimento-c-icon.svg',
        'nome' => 'Investimentos',
        'link' => 'investimentos.php'
    ],
    [
        'icone' => 'perg-gerais.svg',
        'nome' => 'Perguntas frequentes',
        'link' => 'faq.php'
    ],
    [
        'icone' => 'hist-icn-index.svg',
        'nome' => 'Histórico de transações',
        'link' => 'historico.php'
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">

    <style>
        /* estilização dos 2 tipos de containers */
        .container-azul {
            margin: 130px auto 0;
            width: 75%;
            background-color: #0088dc;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-radius: 20px;
        }

        .container-branco {
            margin: 130px auto 0;
            width: 75%;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 20px;
        }


        /*estilização da div banner e suas imagens*/
        .banner {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F1F6FA;
        }

        .banner-container-in {
            width: 75%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .img-cartoes {
            width: 30%;
        }

        .cartoes-caindo {
            width: 100%;
        }

        .banner-content {
            width: 50%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /*estilização dos textos do banner*/
        .banner-title {
            width: 100%;
            font-size: 60px;
            margin-top: 0;
            margin-bottom: 0;
            font-weight: bold;
            letter-spacing: 3px;
            padding-bottom: 40px;
        }

        .banner-frase {
            width: 100%;
            font-size: 20px;
            text-align: justify;
        }

        .span-azul {
            color: #0088dc;
        }

        /* estilização dos botões */
        .banner-buttons {
            display: flex;
            width: 100%;
            margin-top: 40px;
            justify-content: space-between;
            align-items: center;
        }

        .btn-azul {
            width: 140px;
            height: 45px;
        }

        .button-saibamais,
        .button-saibamais-branco {
            font-size: 18px;
        }

        /* titulos de cada seção */
        .title-session {
            margin: 0;
            width: 100%;
            font-size: 35px;
            font-weight: bold;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;

        }

        .subtitle-branco {
            width: 100%;
            font-size: 19px;
            margin-bottom: 30px;
            color: #fff;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .title-sessionBranco {
            font-weight: bold;
            width: 100%;
            font-size: 35px;
            margin-top: 0;
            margin-bottom: 20px;
            color: #fff;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /*carrossel de cards*/
        .carroussel {
            width: 75%;
            display: flex;
            justify-content: center;
            position: relative;
            /* Necessário para posicionar os botões dentro do carrossel */
            overflow-x: hidden;
            flex-direction: column;
            margin: 130px auto 0;
            align-items: center;
        }

        .carroussel-container {
            display: flex;
            transition: transform 0.5s ease;
            /* Animação de transição ao mover os cards */
            scroll-snap-type: x mandatory;
            /* Garante que o carrossel pare nos cards */
            position: relative;
        }

        .carroussel-container a {
            text-decoration: none;
            color: #000000;
        }

        /* Estilos para os botões de navegação */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: 0;
            color: #0088dc;
            border-radius: 12px;
            font-size: 30px;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .carousel-btn.prev {
            left: 10px;
        }

        .carousel-btn.next {
            right: 1px;
        }

        /* estilização dos cards */
        .card-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* estilização e animação do botão */
        .card-content a {
            text-decoration: none;
            color: #000000;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            background-color: transparent;
            border: 0;
            padding: 0;
            margin-top: 20px;
            color: #000000;
            position: relative;
            transition: 0.5s ease;
            display: flex;
            align-items: center;
        }

        .card-content a::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            height: 2px;
            width: 0;
            background-color: #000000;
            transition: 0.5s ease;
        }


        .card-content a:hover::before {
            width: 100%;
        }

        .card-title {
            margin-bottom: 0;
        }

        .card-content p {
            font-weight: bold;
            text-align: center;
        }

        .card-icon {
            height: 80px;
        }

        .card-body {
            height: 280px;
            width: 250px;
            border-radius: 12px;
            margin-top: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 5px;
            margin-left: 50px;
        }

        .card-body:not(:last-child) {
            margin-right: 40px;
        }

        /* contas */
        .accts-container {
            margin: 0 auto;
            width: 85%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 130px;
            background-color: #0088dc;
            border-radius: 20px;
        }

        .img-acct {
            width: 25%;
        }

        .perfil-conta {
            width: 100%;
            border-radius: 8px;
        }

        .acct {
            width: 45%;
            height: 450px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            margin-left: 50px;
        }


        .acct p {
            width: 100%;
            color: #fff;
            display: flex;
            align-items: center;
        }

        .check img {
            margin: 0;

        }

        .acct-sub {
            display: grid;
        }

        .acct-sub p {
            display: flex;
            align-items: center;
        }

        .sub-p {
            margin-top: 3px;
        }

        .sub-p img {
            margin-right: 7px;
        }



        .acct-sub button {
            width: 140px;
        }

        /*estilização da seção "Empréstimos" */
        .container-emp {
            width: 85%;
            margin: 130px auto 0;
            height: 300px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .box-container-emp {
            width: 45%
        }

        .box-container-emp p {
            width: 100%;
        }

        .frase-container {
            font-size: 19px;
            color: #000000;
            margin: 50px 0 30px;
        }

        .emprestimo-img {
            width: 100%;
            border-radius: 8px;
        }

        .emp-img {
            width: 25%;
        }

        /* estilização da seção "Investimentos */
        .container-inv {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .img-inves {
            width: 40%;
        }

        .box-p-inv {
            width: 45%;
            height: 450px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .frase-container-inv {
            font-size: 19px;
        }

        .investimentos-img {
            width: 100%;
        }

        .button-saibamaisBranco1 a {
            text-decoration: none;
            color: #fff;
        }


        .button-saibamaisBranco1 {
            text-align: left;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            background-color: transparent;
            border: 0;
            padding: 0;
            color: #fff;
            position: relative;
            transition: 0.5s ease;
            display: flex;
            align-items: center;
            width: max-content;
        }

        .button-saibamaisBranco1::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            height: 2px;
            width: 0;
            background-color: #fff;
            transition: 0.5s ease;
        }


        .button-saibamaisBranco1:hover::before {
            width: 100%;
        }

        .button-saibamaisBranco1 img {
            height: 15px;
            margin-left: 10px;
        }

        /* estilização da seção "cartões" */
        .title-cards {
            margin: 0;
            width: 100%;
            font-size: 35px;
            font-weight: bold;
            text-align: center;
        }

        .container-cards {
            width: 85%;
            margin: 130px auto 130px;
            height: 650px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .frase-container-cards {
            font-size: 19px;
            color: #000000;
            margin: 50px 0 30px;
            text-align: center;
        }

        .cards-img-box {
            margin: 20px auto 20px;
            width: 23%;
        }

        .cards-img {
            width: 100%;
        }


        /* responsividade */
        @media screen and (max-width: 1440px){
            .carroussel-container{
                margin-left: 300px;
            }
        }
        @media screen and (max-width: 1024px) {
            .banner-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-azul {
                margin-bottom: 30px;
            }

            .img-cartoes {
                width: 40%;
            }

        }
        @media screen and (max-width: 1024px){
            .carroussel-container{
                margin-left: 600px;
            }
        }

        .card-body {
            position: relative;
            left: 40%;
        }

        @media screen and (max-width: 1024px){
            .img-acct .emp-img .cards-img-box{
                width: 35%;
            }

            .container-azul .container-branco{
                justify-content: space-evenly;
                margin: 0;
            }
        }


        @media screen and (max-width: 900px) {
            .acct {
                height: 480px;
            }

            .container-azul {
                flex-direction: column;
                height: max-content;
            }

            .button-saibamaisBranco1 {
                margin-bottom: 20px;
            }

            .box-p-inv,
            .acct {
                margin-left: 0;
                width: 70%;
            }

            .box-p-inv {
                height: max-content;
            }

            .container-inv {
                flex-direction: column;
                height: 450px;
                justify-content: space-evenly;
            }

            .img-inves,
            .cards-img-box {
                width: 50%;
            }

        }

        @media screen and (max-width: 768px) {
            .container-branco {
                flex-direction: column;
                height: 560px;
            }

            .container-azul{
                height: 700px;
                justify-content: space-evenly;
            }

            .box-container-emp {
                width: 100%;
            }

            .img-acct, .emp-img, .img-inves{
                width: 65%;
            }

            .acct {
                width: 75%;
                height: 330px;
                justify-content: flex-end;
            }

            .button-saibamaisBranco1 {
                width: 100%;
            }

            .carroussel-container{
                margin-left: 900px;
            }
        }

        @media screen and (max-width: 480px) {
            .banner {
                height: 100vh;
            }

            .container-inv {
                height: 500px;
            }

            .img-inves {
                width: 60%;
            }

            .emp-img {
                width: 70%;
            }

            .container-branco {
                height: 500px;
            }

            .footer-links-container2 {
                padding-top: 60px;
            }

            .card-body {
                width: 155px;
                left: 100%;
            }

            .carroussel-container {
                position: relative;
                left: 85%;
            }
        }
        @media screen and (max-width: 425px){
            .acct{
                height: 370px;
            }

            .carroussel-container{
                margin-left: -50px;
            }

            .img-acct, .img-inves{
                width: 75%;
            }

            .emp-img{
                width: 100%;
            }

            .container-branco{
                justify-content: space-between;
                height: 550px;
            }

            .img-cartoes{
                display: none;
            }

            .banner{
                height: 80vh;
            }

            .banner-container-in{
                display: grid;
            }

            .banner-content{
                width: 100%;
            }
            
            .container-azul{
                justify-content: space-evenly;
            }
        }

        @media screen and (max-width: 375px){
            .img-acct, .img-inves{
                display: none;
            }

            .acct{
                height: max-content;
            }

            .container-azul{
                height: 60vh;
            }

            .cards-img-box{
                width: 75%;
            }
        }
    </style>
    <script>
        let currentIndex = 0;

        function moveCarousel(direction) {
            const container = document.querySelector('.carroussel-container');
            const totalCards = document.querySelectorAll('.card-body').length; // Total de cards
            const cardWidth = document.querySelector('.card-body').offsetWidth + 20; // Incluindo margem e padding

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
    <div class="body">
        <?php require_once './navbar.php'; ?>

        <!-- banner do site -->
        <div class="banner">
            <div class="banner-container-in">
                <div class="banner-content">
                    <p class="banner-title">Neo<span class="span-azul">Bank</span></p>
                    <p class="banner-frase">No NeoBank o seu futuro financeiro está em boas mãos. Nossa missão é fornecer soluções financeiras inovadoras e seguras para ajudá-lo a alcançar seus sonhos. Junte-se a nós e descubra um novo mundo de possibilidades.</p>

                    <!-- botões -->
                    <div class="banner-buttons">
                        <a href="login.php">
                            <button class="btn-azul">Entrar</button> <!-- botão deve redirecionar para a página de cadastro -->
                        </a>

                        <a href="sobrenos.php">
                            <button class="button-saibamais">Conheça o NeoBank <img src="../img/setaDiagonal.png"></button> <!-- botão deve redirecionar para a página "Sobre nós" -->
                        </a>
                    </div>
                </div>
                <div class="img-cartoes">
                    <img src="../img/cards-form.svg" class="cartoes-caindo">
                </div>
            </div>

        </div>

        <!-- carrossel de cards -->

        <div class="carroussel">
            <p class="title-session">Acesso rápido</p>
            <div class="carroussel-container">
                <?php
                $count = 0;
                foreach ($cards as $card) {
                    echo '
                    <a href="' . $card['link'] . '"=' . $count . '">
                    <div class="card-body">
                    <div class="card-content">
                    <img src="../img/' . $card['icone'] . '"class="card-icon">
                    <p class="card-title">' . $card['nome'] . '</p>
                    </div>
                    </div>
                    </a>
                    ';
                    $count++;
                }
                ?>
            </div>
            <!-- Adicionando botões de navegação -->
            <button class="carousel-btn prev" onclick="moveCarousel(-1)">&#10094;</button>
            <button class="carousel-btn next" onclick="moveCarousel(1)">&#10095;</button>
        </div>
    </div>
    </div>


    <!-- Contas -->
    <div class="container-azul">
        <div class="acct">
            <p class="title-sessionBranco">Abra sua conta</p>
            <p class="subtitle-branco">Abra sua conta e simplifique sua vida financeira com nossas soluções práticas, eficientes e seguras.</p>
            <p class="sub-p"><img src="../img/corretoBranco-icon.png" class="check">Segurança máxima</p>
            <p class="sub-p"><img src="../img/corretoBranco-icon.png" class="check">Gerenciamento financeiro<br>na palma da mão</p>

            <!-- botão deve direcionar para a página de login/cadastro -->
            <a href="cadastro.php">
                <button class="button-saibamaisBranco">Cadastrar-se<img src="../img/setaDiagonalBranco.png">
            </a>
            </button>
        </div>
        <div class="img-acct">
            <img src="../img/index-acct.jpg" class="perfil-conta">
        </div>

    </div>

    <!-- Empréstimos -->
    <div class="container-branco">
        <div class="box-container-emp">
            <p class="title-session">Transações</p>
            <p class="frase-container">Facilite sua rotina financeira com nosso sistema de transações seguro e eficiente. Com acesso disponível 24 horas por dia, você pode gerenciar suas finanças de maneira conveniente e sem complicações, sempre que precisar.</p>
            <a href="./transacoes.php"> <!-- botão deve direcionar para a página de empréstimos -->
                <button class="button-saibamais">
                    Veja sobre Transações <img src="../img/setaDiagonal.png">
                </button>
            </a>
        </div>
        <div class="emp-img">
            <img src="../img/emprestimo_img.png" class="emprestimo-img">
        </div>
    </div>

    <!-- Investimentos -->
    <div class="container-azul">
        <div class="container-inv">
            <div class="box-p-inv">
                <p class="title-sessionBranco">Faça seu dinheiro render</p>
                <p class="subtitle-branco">Invista com a gente e construa um futuro financeiro próspero, garantindo mais tranquilidade para você e sua família.
                </p>

                <!-- botão deve direcionar para a página de investimentos -->
                <a href="investimentos.php">
                    <button class="button-saibamaisBranco1">
                        Veja por que investir pelo NeoBank
                        <img src="../img/setaDiagonalBranco.png">
                </a>
                </button>

            </div>
            <div class="img-inves">
                <img src="../img/cdb-img.svg" class="investimentos-img">
            </div>
        </div>
    </div>

    <div class="container-cards">
        <p class="title-cards">Escolha seu cartão</p>
        <p class="frase-container-cards">Descubra a liberdade financeira com nossos cartões,<br>oferecendo benefícios exclusivos e praticidade para o seu dia a dia.</p>
        <div class="cards-img-box">
            <img src="../img/cards.svg" class="cards-img">
        </div>
        <div>
            <a href="./cards.php">
                <button class="button-saibamais">Conheça nossos cartões<img src="../img/setaDiagonal.png">
            </a>
            </button>
        </div>
    </div>

</body>
<?php require_once './footer.php'; ?>

</html>