<?php

// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

//array associativo com os valores da empresa
$cardsvalores1 = [
    [
        'img' => '../img/transparencia-icon.svg',
        'title' => 'Transparência',
        'frase' => 'Operamos com clareza e honestidade em todas as transações e comunicações.'
    ],
    [
        'img' => '../img/seguranca-icon.svg',
        'title' => 'Segurança',
        'frase' => 'Mantemos a confiança dos clientes através de práticas 100% seguras e transparentes.'
    ],
    [
        'img' => '../img/inclusao-icon.svg',
        'title' => 'Inclusão',
        'frase' => 'Cada voz conta, e juntos, construímos um ambiente mais forte e inovador.'
    ],
    [
        'img' => '../img/inovacao-icon.svg',
        'title' => 'Inovação',
        'frase' => 'Operamos com clareza e honestidade em todas as transações e comunicações.'
    ],
    [
        'img' => '../img/qualquer-icon.svg',
        'title' => 'Sustentabilidade',
        'frase' => 'Investindo hoje em práticas responsáveis para garantir um futuro financeiro sólido e ecologicamente equilibrado.'
    ],
    [
        'img' => '../img/cliente-icon.svg',
        'title' => 'Foco no cliente',
        'frase' => 'Priorizar suas necessidades é nossa missão, construindo confiança e promovendo prosperidade.'
    ]
];


/* arroy associativo da seção "o que as pessoas acham do NeoBank */
$opinioes = [
    [
        'img' => '../img/estrelas.svg',
        'frase' => '“Desde que abri minha conta no NeoBank, minha experiência bancária mudou completamente. A plataforma é extremamente fácil de usar. Recomendo!”',
        'nome' => 'Júlia S.',
        'funcao' => 'Cliente satisfeita'
    ],
    [
        'img' => '../img/estrelas.svg',
        'frase' => '"Abrir uma conta no NeoBank foi a melhor decisão que tomei. A praticidade de fazer todas as transações pelo aplicativo é simplesmente fantástica."',
        'nome' => 'Ana L.',
        'funcao' => 'Estudante universitária'
    ],
    [
        'img' => '../img/estrelas.svg',
        'frase' => '“O NeoBank revolucionou minha vida financeira. A tecnologia de ponta e a segurança oferecida me dão a tranquilidade que eu preciso.”',
        'nome' => 'Marcos P.',
        'funcao' => 'Empresário'
    ]
];

$redes = [
    [
        'img' => '../img/face-icon-preto.svg',
        'link' => 'https://pt-br.facebook.com/'
    ],
    [
        'img' => '../img/insta-icon-preto.svg',
        'link' => 'https://www.instagram.com/'
    ],
    [
        'img' => '../img/linkedin-icon-preto.svg',
        'link' => 'https://www.linkedin.com/'
    ],
    [
        'img' => '../img/ytb-icon-preto.svg',
        'link' => 'https://www.youtube.com/'
    ]
];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nós</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">

    <style>
        body {
            justify-items: center;
        }

        main {
            width: 75%;
            justify-items: center;
        }

        .span-azul {
            color: #0088dc;
        }

        .title-session {
            font-size: 30px;
            margin: 0 0 30px;
            font-weight: bold;
        }

        .linha {
            width: 100%;
            margin: 30px auto 0;
        }


        /*estilização da div banner*/
        .banner {
            margin-top: 40px;
            justify-items: center;
            width: 100%;
        }

        .banner-img {
            width: 50%;
            justify-items: center;
        }

        .banner-img img {
            width: 100%;
            border-radius: 8px;
        }

        .banner-content {
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 75%;
        }

        /*estilização dos textos do banner*/
        .banner-title {
            font-size: 60px;
            margin-top: 0;
            margin-bottom: 0;
            font-weight: bold;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            letter-spacing: 2px;
            padding-bottom: 40px;
            text-align: center;
        }

        .banner-frase {
            font-size: 16px;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
        }

        /* estilização da seção "nossa história" */
        .session {
            width: 100%;
            display: flex;
            margin: 65px 0 0;
            flex-direction: column;
        }

        .text-session1 {
            font-size: 20px;
            text-align: justify;
            margin-bottom: 35px;
        }

        /* estilização da seção "nossos valores */
        .title-card {
            font-weight: bold;
            font-size: 20px;
        }

        .frase-card,
        .title-card {
            text-align: center;
        }

        .frase-card {
            font-size: 17px;
            margin: 0;
        }

        .container-cards {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 150px;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .valores-card {
            width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .valores-card img {
            height: 50px;
        }

        /* estilização da seção "o que as pessoas acham do neobank */
        .opnion-card {
            width: 250px;
            height: 220px;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
            border-radius: 10px;
            padding: 25px;
        }

        .container-opnion {
            display: flex;
            justify-content: space-between;
            text-align: justify;
            margin: 30px 0 60px;
            align-items: center;
            width: 100%;
        }

        .opinion-nome {
            font-weight: bold;
            margin: auto 0 6px;
        }

        .opnion-funcao {
            color: #1a191e87;
            margin: 0;
            font-size: 15px;

        }

        .opnion-frase {
            margin: 20px 0 30px;
            font-size: 17px;
        }


        /* redes sociais */
        .img-redes {
            width: 60%;
        }

        .img-redes img {
            width: 100%;
        }

        .container-redes {
            display: flex;
            justify-content: space-between;
            text-align: justify;
            margin: 30px 0 130px;
            align-items: center;
        }

        .redes-icones {
            width: 40px;
        }

        .redes-container {
            display: flex;
            justify-content: flex-end;
            width: 30%;
            flex-wrap: wrap;
            gap: 20px 20px;
            align-items: center;
        }

        /* responsividade */
        @media screen and (max-width: 1230px) {
            .container-opnion {
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
            }

            .opnion-card {
                width: 220px;
                height: 240px;
            }
        }

        @media screen and (max-width: 1149px){
            .valores-card{
                width: 200px;
            }
        }

        @media screen and (max-width: 1100px) {
            .opnion-card {
                width: 190px;
                height: 270px;
            }

            .banner-title {
                font-size: 55px;
            }

            .redes-icones {
                width: 35px;
                height: auto;
            }
        }

        @media screen and (max-width: 980px) {
            .container-opnion {
                justify-content: space-evenly;
                height: 620px;
            }

            .opnion-card {
                width: 220px;
                height: 230px;
            }

            .valores-card {
                width: 215px;
            }
        }

        @media screen and (max-width: 750px) {
            .container-opnion {
                flex-wrap: nowrap;
                height: max-content;
                flex-direction: column;
            }

            .opnion-card {
                width: 100%;
                height: 180px;
                margin-bottom: 30px;
            }

            .redes-icones {
                width: 30px;
                height: auto;
            }

            .container-cards {
                justify-content: center;
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
                gap:20px
            }

        }

        @media screen and (max-width: 670px){
            .banner-title{
                font-size: 40px;
            }
        }

        @media screen and (max-width: 640px){
            .valores-card{
                width: 140px;
            }
        }

        @media screen and (max-width: 540px) {
            .opnion-card {
                width: 100%;
                height: 230px;
                margin-bottom: 30px;
            }
            .banner-title{
                font-size: 35px;
            }

        }

        @media screen and (max-width: 460px){
            .redes-icones {
                width: 25px;
                height: auto;
            }

            .container-cards {
                justify-content: center;
                display: flex;
                flex-wrap: wrap;
                flex-direction: row;
                gap:30px
            }
        }

        @media screen and (max-width: 360px){
            .container-redes{
                flex-direction: column;
            }

            .redes-container{
                width: max-content;
                flex-wrap: nowrap;
                flex-direction: row;
                margin-top: 20px;
            }

            .banner-img{
                width: 75%;
            }
        }
    </style>
</head>

<body>
    <?php require_once './navbar.php'; ?>

    <div class="banner">
        <div class="banner-content">
            <p class="banner-frase">Sobre nós</p>
            <p class="banner-title">Conheça o Grupo<br>Neo<span class="span-azul">Bank</span></p>
        </div>
        <div class="banner-img">
            <img src="../img/banner-nb.png">
        </div>
    </div>

    <main>

        <div class="session">
            <p class="title-session">Nossa <span class="span-azul">História</span></p>
            <p class="text-session1">
                Desde o início, a nossa visão era clara: criar um banco que fosse mais do que apenas um lugar para guardar dinheiro, mas um verdadeiro parceiro na jornada financeira de cada cliente.<br><br>
                Logo de inicio, enfrentamos alguns desafios significativos, porém nossa dedicação e compromisso com a excelência nos impulsionaram a superar cada obstáculo.
                <br><br>
                Hoje, o NeoBank é reconhecido não apenas pela inovação, mas também pela forma como coloca os clientes no centro de tudo o que fazemos. Convidamos você a fazer parte dessa jornada, porque no NeoBank, o futuro das finanças é agora.
            </p>
            <img src="../img/line.svg" class="linha">
        </div>

        <div class="session">

            <p class="title-session">Nossos <span class="span-azul">valores</span></p>

            <div class="container-cards">

                <?php
                foreach ($cardsvalores1 as $valorescard) {
                    echo '
            <div class="valores-card">
            <img src="' . $valorescard['img'] . '" class="valores-img">
            <p class="title-card">' . $valorescard['title'] . '</p>
            <p class="frase-card">' . $valorescard['frase'] . '</p>
            </div>
            
            ';
                }
                ?>
            </div>

        

            <img src="../img/line.svg" class="linha">

        </div>

        <div class="session">
            <p class="title-session">O que as pessoas<br><span class="span-azul">acham </span>do Neo<span class="span-azul">Bank</span></p>
            <div class="container-opnion">
                <?php
                foreach ($opinioes as $opiniao) {
                    echo '
            <div class="opnion-card">
            <img src="' . $opiniao['img'] . '">
            <p class="opnion-frase">' . $opiniao['frase'] . '</p>
            <p class="opinion-nome">' . $opiniao['nome'] . '</p>
            <p class="opnion-funcao">' . $opiniao['funcao'] . '</p>
            </div>
            
            ';
                }
                ?>
            </div>
            <img src="../img/line.svg" class="linha">
        </div>

        <div class="session">
            <p class="title-session">Acompanhe o Neo<span class="span-azul">Bank</span><br> nas redes sociais</p>
            <div class="container-redes">
                <div class="img-redes">
                    <img src="../img/img-redessociais.svg">
                </div>
                <div class="redes-container">
                    <?php
                    foreach ($redes as $rede) {
                        echo '
                <a href="' . $rede['link'] . '" target="_blank">
                <img src="' . $rede['img'] . '" class="redes-icones">
                </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

<?php require_once './footer.php'; ?>

</html>