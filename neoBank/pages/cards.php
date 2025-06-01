<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão
//Arrays Beneficios

$basico = [
    [
        'icon' => 'dados.svg',
        'nome' => 'Dados seguros',
        'verificacao' => 'check.svg'
    ],

    [
        'icon' => 'cartaodig.svg',
        'nome' => "Cartão Digital",
        'verificacao' => 'check.svg'
    ],
    [
        'icon' => 'taxa.svg',
        'nome' => 'Nenhuma taxa de anuidade',
        'verificacao' => 'check.svg'
    ]
];

$basico2 = [
    [
        "icon" => "mastercard.svg",
        "nome" => "Benefícios Mastercard Gold",
        "verificacao" => "check.svg",
        "verificacao1" => "uncheck1.svg",
    ],

    [
        "icon" => "cashback.svg",
        "nome" => "Bônus de 4% de cashback",
        "verificacao" => "check.svg",
        "verificacao1" => "uncheck1.svg",
    ],

    [
        "icon" => "setaBaixo.svg",
        "nome" => "Descontos exclusivos",
        "verificacao" => "Check.svg",
        "verificacao1" => 'uncheck1.svg',
    ],
];

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartões NeoBank</title>
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/global.css">

    <style>
        section {
            margin: 130px 0 0;
        }

        main {
            justify-items: center;
        }

        .span-azul {
            color: #0088dc;
        }


        /*Banner Inicial*/
        .banner {
            width: 100%;
            height: 90vh;
            background-color: #F1F6FA;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
        }

        .banner-box {
            display: flex;
            align-items: center;
        }

        .banner-content {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .banner p {
            font-size: 65px;
            font-weight: bold;
            margin: 0 0 130px;
            text-align: center;
        }


        .bannerbox-img {
            width: 100%;
        }

        /*Sessão do Cartão*/

        .cardAling {
            width: 75%;
            justify-items: center;
        }

        .blackCard {
            margin-left: 200px;
        }

        .container-cards {
            display: flex;
            width: 100%;
            justify-content: space-evenly;
        }
        

        .box-cards {
            height: 260px;
            width: 30%;
            display: flex;
            flex-direction: column;

        }

        .cards-p {
            display: flex;
            width: 100%;
            justify-content: center;
        }

        .sub-title-cards {
            background-color: #F1F6FA;
            width: 118px;
            height: 30px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-size: 16px;
            color: #0088DC;
        }


        .title-cards {
            margin: 0 15px 0 0;
            font-size: 25px;
            font-weight: bold;
        }


        /*Desing do Cartão*/
        .card {
            perspective: 600px;
            margin-top: 30px;
        }

        .cartao-img {
            width: 100%;
        }

        /*Cartão linha Basica*/
        .card__part {
            position: absolute;
            background-repeat: no-repeat;
            background-position: center;
            transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -webkit-transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
        }

        /*Cartão linha NeoBlack*/
        .card__part2 {
            box-shadow: 1px 1px #aaa3a3;
            top: 0;
            position: absolute;
            left: 0;
            display: inline-block;
            width: 320px;
            height: 190px;
            background: linear-gradient(to right, #000000, #3A404A);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius: 8px;
            -webkit-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -moz-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -ms-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -o-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
        }

        .card__front {
            -webkit-transform: rotateY(0);
            -moz-transform: rotateY(0);
            width: 100%;
        }

        .card__back {
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            width: 100%;
        }

        .card:hover .card__front {
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);

        }

        .card:hover .card__back {
            -webkit-transform: rotateY(0deg);
            -moz-transform: rotateY(0deg);
        }

        /* botões "peça já" */

        .button-saibamais1 a {
            text-decoration: none;
            color: #0088dc;
        }

        .button-saibamais1 {
            font-weight: bold;
            cursor: pointer;
            background-color: transparent;
            border: 0;
            padding: 0;
            color: #0088dc;
            position: relative;
            transition: 0.5s ease;
            width: max-content;
            text-align: left;
        }

        .button-saibamais1::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            height: 2px;
            width: 0;
            background-color: #0088dc;
            transition: 0.5s ease;
        }


        .button-saibamais1:hover::before {
            width: 100%;
        }

        .button-saibamais1 img {
            height: 15px;
            margin-left: 10px;
        }

        .container-buttons {
            margin-top: 80px;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
        }

        .buttons-cards, .buttons-cards1 {
            width: 320px;
            display: flex;
            justify-content: center;
        }

        .button-saibamais,
        .button-saibamais1 {
            font-size: 16px;
        }

        /*Sessão de beneficios*/
        .ben-nomes{
            display:none;
        }

        .container-beneficios {
            width: 75%;
            margin-bottom: 130px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .beneficios {
            padding: 20px 0 10px 0;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 60px;
        }

        .icon {
            display: flex;
            align-items: center;
            width: 20%;
        }

        .icon h2 {
            font-size: 18px;
            margin: 0 0 0 20px;
        }

        .icon img {
            height: 60px;
        }

        .verificacao {
            display: flex;
            justify-content: space-between;
            width: 50%;
        }

        .verificacao img {
            height: 50px;
        }

        .linha {
            width: 100%;
        }

        /* responsividade */
        @media screen and (max-width: 1300px) {
            .box-cards {
                height: 240px;
            }

            .banner{
                height: 80vh;
            }

            .container-buttons {
            margin-top: 20px;
        }
        }

        @media screen and (max-width: 1100px) {
            .box-cards {
                height: 210px;
            }

            .banner{
                height: 70vh;
            }
        }

        @media screen and (max-width: 850px) {
            .title-cards {
                font-size: 20px;
            }

            .sub-title-cards {
                width: 90px;
                font-size: 14px;
            }

            .button-saibamais,
            .button-saibamais1 {
                font-size: 14px;
            }

            .box-cards {
                height: 170px;
            }

            .container-buttons {
                width: 90%;
            }

            .icon img, .verificacao img{
                height: 50px;
            }

            .icon h2{
                font-size: 16px;
            }

            .banner{
                height: 60vh;
            }
        }

        @media screen and (max-width: 750px) {
            .box-cards {
                height: 150px;
            }

            .icon img, .verificacao img{
                height: 45px;
            }

            .icon h2{
                font-size: 14px;
            }

            .banner{
                height: 60vh;
            }

            .banner p{
                font-size: 60px;
            }
        }

        @media screen and (max-width: 600px) {
            .container-cards {
                flex-direction: column;
                height: 55vh;
                justify-content: space-between;
                align-items: center;
            }

            .box-cards {
                height: 190px;
                width: 50%;
            }

            .button-saibamais1 {
                width: 0;
                height: 0;
                display: none;
            }

            .container-buttons {
                justify-content: center;
                margin-top: 40px;
            }

            .cards {
                margin-top: 15px;
            }

            .ben-nomes{
                display: flex;
                justify-content: space-evenly;
                margin-left: 60px;
                font-weight: bold;
            }

            .banner{
                height: 50vh;
            }

            .banner p{
                font-size: 50px;
            }

            .buttons-cards1{
                width: 0;
            }

            .icon{
                flex-direction: column;
            }

        }

        @media screen and (max-width: 500px){
            .container-cards{
                height: 50vh;
            }

            .container-buttons{
                margin-top: 0;
            }

            .cardAling{
                margin-top: 90px;
            }
        }

        @media screen and (max-width: 400px){
            .container-cards{
                height: 45vh;
            }

            .box-cards{
                height: 160px;
            }

            .banner p{
                font-size: 40px;
            }
        }

        @media screen and (max-width: 350px){
            .container-cards{
                height: 40vh;
            }
        }
    </style>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <div class="banner">
        <div class="banner-content">
            <div class="banner-box">
                <p>O cartão ideal<br>para <span class="span-azul">você</span></p>
            </div>
        </div>
        <img src="../img/cards-banner.svg" alt="cards" class="bannerbox-img">

    </div>
    <main>
        <section class="cardAling">
            <!--Linha dos cartoes-->
            <div class="container-cards">

                <!--Cartão Basico-->

                <div class="box-cards">
                    <div class="cards-p">
                        <p class="title-cards">Básico</p>
                        <p class="sub-title-cards">Popular</p>
                    </div>

                    <div class="card"> <!--Parte frontal do cartão-->
                        <div class="card__front card__part">
                            <img src="../img/cartaoAzul-frente.svg" class="cartao-img">
                        </div>


                        <div class="card__back card__part"> <!--Parte de trás do cartão-->
                            <img src="../img/cartaoAzul-verso.svg" class="cartao-img">
                        </div>
                    </div>


                </div>

                <!--Cartão Black-->

                <div class="box-cards">
                    <div class="cards-p">
                        <p class="title-cards">NeoBlack</p>
                        <p class="sub-title-cards">Premium</p>
                    </div>

                    <div class="card"> <!--Parte frontal do cartão-->
                        <div class="card__front card__part">
                            <img src="../img/cardBlack-frente.svg" class="cartao-img">
                        </div>

                        <div class="card__back card__part"> <!--Parte de trás do cartão-->
                            <img src="../img/cardBlack-verso.svg" class="cartao-img">
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-buttons">
                <!-- botões devem redirecionar para o formulário de solicitação do cartão -->
                <div class="buttons-cards">
                    <a href="cardsForms.php">
                        <button class="button-saibamais">Peça já o seu cartão<img src="../img/setaDiagonal.png"></button>
                    </a>
                </div>

                <div class="buttons-cards1">
                    <a href="cardsForms.php">
                        <button class="button-saibamais1">Peça já o seu NeoBlack<img src="../img/setaDiagonal.png"></button>
                    </a>
                </div>
            </div>

        </section>

        <!--Benefios Básico X NeoBlack-->
        <section class="container-beneficios">
            <div class="ben-nomes">
                <p>Básico</p>
                <p>NeoBlack</p>
            </div>
            <?php
            foreach ($basico as $basic) {
                print '
                 <div class="beneficios">
                <div class="icon">
                    <img src="../img/' . $basic['icon'] . '">
                    <h2>' . $basic['nome'] . '</h2>
                </div>

                <div class="verificacao">
                     <img src="../img/' . $basic['verificacao'] . '">
                     <img src="../img/' . $basic['verificacao'] . '">
                </div>
            </div>
             <img src="../img/line900px.svg" class="line-img">


                 ';
            }


            foreach ($basico2 as $basic2) {
                print '
                 <div class="beneficios">
                <div class="icon">
                    <img src="../img/' . $basic2['icon'] . '">
                    <h2>' . $basic2['nome'] . '</h2>
                </div>

                <div class="verificacao">
                <img src="../img/' . $basic2['verificacao1'] . '">
                     <img src="../img/' . $basic['verificacao'] . '">
                </div>
            </div>
            <img src="../img/line900px.svg" class="linha">

                 ';
            }
            ?>
        </section>
    </main>
</body>
<!-- footer -->
<?php require_once './footer.php'; ?>

</html>