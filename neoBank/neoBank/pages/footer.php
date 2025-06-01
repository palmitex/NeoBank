<?php

/* array associativo das páginas e contatos da empresa e seus respectivos links */
$columnLinks1 = [
    [
        'nome' => 'Página inicial',
        'link' => './index.php'
    ],
    [
        'nome' => 'Investimentos',
        'link' => 'investimentos.php'
    ],
    [
        'nome' => 'Transações',
        'link' => './transacoes.php'
    ],
    [
        'nome' => 'Cartões',
        'link' => './cards.php'
    ]
];

$columnLinks2 = [
    [
        'nome' => '0800 123 4567',
        'link' => 'tell:08001234567'
    ],
    [
        'nome' => 'suporte@neobank.com',
        'link' => 'mailto:suporte@neobank.com'
    ]
];

$columnLinks3 = [
    [
        'nome' => 'Política de privacidade',
        'link' => 'politicas.php'
    ],
];

$columnLinks4 = [
    [
        'nome' => 'Sobre nós',
        'link' => './sobrenos.php'
    ],
    [
        'nome' => 'Perguntas frequentes',
        'link' => './faq.php'
    ]
];

/* array associativo dos icones de redes socias e seus respectivos links */
$socialmidias = [
    [
        'nome' => 'LinkedIn',
        'img' => '../img/linkedin-icon.svg',
        'link' => 'https://www.linkedin.com/'
    ],
    [
        'nome' => 'Facebook',
        'img' => '../img/face-icon.svg',
        'link' => 'https://pt-br.facebook.com/'
    ],
    [
        'nome' => 'Instagram',
        'img' => '../img/insta-icon.svg',
        'link' => 'https://www.instagram.com/'
    ],
    [
        'nome' => 'YouTube',
        'img' => '../img/ytb-icon.svg',
        'link' => 'https://www.youtube.com/'
    ]
]
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <title>Footer NeoBank</title>
    <style>
        /* estilização do footer */
        footer {
            width: 100%;
            height: 70vh;
            background-color: #272b31;
            color: #fff;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            letter-spacing: 1.5px;
            align-items: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
        }

        .footer-container {
            display: flex;

        }

        .footer-links-container {
            display: flex;
            justify-content: space-between;
            width: 80%;

        }

        /* estilização dos textos do footer*/
        ul {
            list-style-type: none;
            padding: 0;

        }

        footer a {
            color: #cecece;
            text-decoration: none;
        }

        .container-footer2{
            width: 45%;
            justify-content: space-between;
            display: flex;
        }

        .container-footer1{
            width: 45%;
            justify-content: space-between;
            display: flex;
        }

        .column {
            height: max-content;
            width: max-content;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .column-links {
            margin-bottom: 0;
        }

        .column-links a:hover {
            text-shadow: 0 0 3px #cececea3;
            transition: opacity 0.5s ease-in;
        }

        .column-title {
            font-weight: bold;
            height: max-content;
            font-size: 19px;
            margin-bottom: 10px;
        }

        .f-column {
            margin-bottom: 40px;
        }

        .logo {
            height: 28px;
        }

        /* estilização do botão de download pela App Store e Google play */
        .download-button a {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .download-app {
            display: grid;
        }


        .download-button img {
            height: 35px;
        }

        .download-button {
            background-color: #000000;
            height: 70px;
            width: 200px;
            color: #fff;
            border: 0;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .download-button span {
            font-size: 20px;
            font-weight: bold;
            color: #fff;

        }

        /* estilização dos icones das redes sociais*/

        .footer-links-container2 {
            display: flex;
            justify-content: space-between;
            width: 80%;
            align-items: center;
        }


        .redes-sociais img {
            background-size: cover;
        }

        .redes-sociais img:hover {
            filter: invert(47%) sepia(95%) saturate(4179%) hue-rotate(177deg) drop-shadow(0 0 3px #0088dc91);
        }

        .redes-sociais {
            width: 200px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .copyright {
            color: #cecece;
            font-size: 13px;
            text-align: center;
        }

        /* responsividade */

        @media screen and (max-width: 1000px) {
            .column{
                width: min-content;
            }

            .container-footer1{
                width: 60%;
            }

            .container-footer2 {
                height: max-content;
                width: max-content;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .column-title{
                width: 80%;
            }

        }

        @media screen and (max-width:750px){
            footer{
                height: 110vh;
            }

            .f-column{
                margin-bottom: 20px;
            }

            .footer-links-container{
                height: 70%;
                flex-direction: column;
            }

            .container-footer2, .container-footer1{
                flex-direction: row;
                width: 100%;
            }
        }

        @media screen and (max-width:740px){
            .footer-links-container{
                height: 60vh;
            }

            .copyright{
                width: 75%;
            }
        }

        @media screen and (max-width:470px){
            .copyright{
                width: 80%;
            }
            footer{
                height: 130vh;
            }
            .container-footer1, .container-footer2{
                flex-direction: column;
            }

            .footer-links-container{
                width: 60%;
                align-content: center;
                height: max-content;
            }

            .redes-sociais{
                width: 50%;
            }
        }

        @media screen and (max-width:380px){
            footer{
                height: 170vh;
            }
        }

        @media screen and (max-width: 375px){
            footer{
                height: 150vh;
            }

            .footer-links-container{
                height: 95vh;
            }
        }
    </style>
</head>

<body>
</body>

<footer>
    <!--  páginas e contatos da empresa -->
    <div class="footer-links-container">
        <div class="container-footer1">
        <div class="column">
            <p class="column-title">Conteúdos relevantes</p>
            <?php
            foreach ($columnLinks1 as $column1) {
                echo '
    <ul class="column-links">
            <li>
            <a href="' . $column1['link'] . '" target="_blank">' . $column1['nome'] . '</a>
            </li>
        </ul>
    ';
            }
            ?>
        </div>

        <div class="column">
            <div class="f-column">
                <p class="column-title">Fale conosco</p>
                <?php
                foreach ($columnLinks2 as $column2) {
                    echo '
    <ul class="column-links">
            <li><a href="' . $column2['link'] . '" target="_blank">' . $column2['nome'] . '</a></li>
        </ul>
    ';
                }
                ?>
            </div>
            <div>
                <p class="column-title">O NeoBank</p>
                <?php
                foreach ($columnLinks4 as $column4) {
                    echo '
    <ul class="column-links">
            <li>
            <a href="' . $column4['link'] . '" target="_blank">' . $column4['nome'] . '</a>
            </li>
        </ul>
    ';
                }
                ?>
            </div>
        </div>
        </div>

        <div class="container-footer2">
            <div class="column">

                <p class="column-title">Transparência</p>
                <?php
                foreach ($columnLinks3 as $column3) {
                    echo '
    <ul class="column-links">
            <li><a href="' . $column3['link'] . '" target="_blank">' . $column3['nome'] . '</a></li>
        </ul>
    ';
                }
                ?>

            </div>

            <!-- botão de download -->
            <div class="download-section">
                <p class="column-title">Baixe o app</p>
                <div class="download-app">
                    <button class="download-button">
                        <a href="https://www.apple.com/br/app-store/" target="_blank">
                            <img src="../img/apple-icon.png">
                            <p>Disponível na<br><span>App Store</span></p>
                        </a>
                    </button>

                    <button class="download-button">
                        <a href="https://play.google.com/store/apps?hl=pt-BR&pli=1" target="_blank">
                            <img src="../img/googleplay-icon.png">
                            <p>Disponível no<br><span>Google Play</span></p>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- icone com link das redes sociais da empresa -->
    <div class="footer-links-container2">
        <a href="./index.php">
            <img src="../img/nb-branco-logo.svg" alt="Logo NeoBank" class="logo">
        </a>

        <div class="redes-sociais">
            <?php
            foreach ($socialmidias as $redessociais) {
                echo '
    <ul class="redes">
            <li>
            <a href="' . $redessociais['link'] . '" target="_blank">
            <img src="' . $redessociais['img'] . '" alt="' . $redessociais['nome'] . '">
            </a>
            </li>
        </ul>
    ';
            }
            ?>
        </div>
    </div>
    <p class="copyright">2024 © NeoBank | Desenvolvido por Gabriel Palmieri, Gustavo Torelli e Julia Alves.</p>
</footer>

</html>