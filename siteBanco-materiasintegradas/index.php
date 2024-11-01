<?php

$navbar = [
    [
        'nome' => 'Página Inicial',
        'link' => 'index.php'
    ],
    [
        'nome' => 'Saque',
        'link' => '#'
    ],
    [
        'nome' => 'Dúvidas frequentes',
        'link' => '#'
    ],
    [
        'nome' => 'Login',
        'link' => '#'
    ]
];

$cards = [
    [
        'icone' => 'user.png',
        'nome' => 'Conta',
        'descricao' => '',
        'link' => '#'
    ],
    [
        'icone' => 'loan.png',
        'nome' => 'Empréstimo',
        'descricao' => 'Precisa de uma mãozinha para realizar seus sonhos? Nossos empréstimos oferecem condições flexíveis, taxas de juros competitivas e prazos que se adaptam à sua necessidade.',
        'link' => '#'
    ],
    [
        'icone' => 'investing.png',
        'nome' => 'Investimentos',
        'descricao' => 'Quer fazer seu dinheiro trabalhar para você? Descubra nossos planos de investimento, desenhados para atender aos seus objetivos financeiros.',
        'link' => '#'
    ],
    [
        'icone' => 'pix_icon.png',
        'nome' => 'Pix',
        'descricao' => 'Experimente a rapidez e a simplicidade do Pix, ele é seguro, fácil de usar e sem complicações. Cadastre sua chave Pix e aproveite todas as vantagens dessa inovação financeira.',
        'link' => '#'
    ],
];

$columnLinks1 = [
    [
        'nome' => 'Sobre nós',
        'link' => '#'
    ],
    [
        'nome' => 'Trabalhe conosco',
        'link' => '#'
    ]
];

$columnLinks2 = [
    [
        'nome' => 'Politica de privacidade',
        'link' => '#'
    ],
    [
        'nome' => 'Politica de segurança',
        'link' => '#'
    ],
    [
        'nome' => 'Ética',
        'link' => '#'
    ]
];

$columnLinks3 = [
    [
        'nome' => 'Politica de privacidade',
        'link' => '#'
    ],
];

$columnLinks4 = [
    [
        'icon' => '',
        'link' => '#'
    ]
]
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /*estilização da navbar*/
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80px;
            max-width: 100%;
            padding: 0px 5%;
            border-radius: 5px;
            background-color: #fff;
            position: sticky;
            box-shadow: 0px 10px 10px -3px rgba(0, 0, 0, 0.1);
        }

        .navlinks {
            display: flex;
            list-style: none;
        }

        .navlinks a {
            font-size: 18px;
            font-weight: bolder;
            text-decoration: none;
            color: #000000;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /*estilização do banner*/
        .banner {
            max-width: 100%;
            height: 655px;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(70,130,180,1) 65%, rgba(55,148,196,1) 86%, rgba(31,176,222,1) 97%, rgba(48,157,204,1) 100%);
            color: #fff;
        }

        .banner-img {
            width: 100%;
            height: 655px;
        }

        .banner-content {
            width: 600px;
            position: absolute;
            font-weight: bold;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            top: 40%;
            left: 10%;
        }

        .banner-title {
            font-size: 3rem;
            margin-top: 0;
        }

        .banner-frase {
            font-size: 1.5rem;

        }

        /*estilização dos cards*/

        .p-card {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 2.3rem;
            font-weight: bold;
            margin-top: 70px;
            margin-bottom: 50px;
            margin-left: 40px;
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 100%;

        }

        .card-container p {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .card-content {
            display: flex;
            font-weight: bold;
            align-items: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 1.3rem;
        }


        .card-body {
            height: 320px;
            width: 260px;
            border-radius: 12px;
            padding: 0px 20px 0px 20px;
            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
            margin-top: 60px;
            margin-left: 40px;
            font-size: 1.1rem;
            margin-left: 0;
            margin-top: 0;
        }

        .card-icon {
            height: 30px;
            display: flex;
            align-items: start;
            margin-right: 10px;
        }

        .button-cards {
            font-weight: bold;
            color: #0088dc;
            font-size: 18px;
            cursor: pointer;
        }

        .button-cards:hover {
            text-decoration: underline;
            transition: transform 0.3s ease-out;
        }

        /* estilização do footer*/
        .footer {
            display: flex;
            background-color: #101820;
            max-width: 100%;
            height: 300px;
            margin-top: 50px;
            align-items: center;
            justify-content: space-around;
        }

        .column-title {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 17px;
            color: #fff;
            font-weight: bold;

        }

        .column-links li a {
            display: inline;
            text-decoration: none;
            list-style: none;
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 15px;
            color: #fff;

        }

        /*estilização da 1° seção*/
        .container1 {
            max-width: 100%;
            height: 600px;
            background-color: #3a404a;
            display: flex;
            justify-content: space-evenly;
        }

        .box-container {
            align-items: center;
            height: 600px;
        }

        .container1 img{
            height: 600px;
        }

        .box-container p {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            width: 700px;
            color: #fff;
        }

        .title-container {
            font-size: 3rem;
            font-weight: bold;
            padding-top: 50px;

        }

        .frase-container {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 1.5rem;
        }
    </style>

</head>

<body>
    <div class="navbar">
        <a href="index.php">
            <img src="./img/logo.png" class="logo">
        </a>
        <?php
        foreach ($navbar as $menu) {
            echo '
            <header class="header">
            <nav>
            <ul class="navlinks">
            <li><a href="' . $menu['link'] . '">' . $menu['nome'] . '</a></li>
            </ul>
            </nav>
            </header>';
        }
        ?>
    </div>

    <div class="banner">
        <div class="banner-content">
            <p class="banner-title">Seu futuro financeiro começa <span>aqui!</span></p>
            <p class="banner-frase"> Segurança, confiança e soluções que transformam seus objetivos financeiros em realidade.</p>
        </div>
        <img src="./img/background.svg" class="banner-img">
    </div>

    <p class="p-card">Acesso rápido</p>

    <div class="card-container">
        <?php
        $count = 0;
        foreach ($cards as $card) {
            echo '
    <div class="card-body">
    <div class="card-content">
     <img src="img/' . $card['icone'] . '"class="card-icon">
    <p class="card-title">' . $card['nome'] . '</p>
    </div>
    <p class="card-text">' . $card['descricao'] . '</p>
    <p class="button-cards"><a href="' . $card['link'] . '"=' . $count . '"></a>Saiba mais</p>
    </div>
    

    ';
            $count++;
        }
        ?>
    </div>

    <div class="container1">
        <div class="box-container">
            <p class="title-container">Abra sua conta</p>
            <p class="frase-container">Abrir sua conta é o primeiro passo para um futuro financeiro brilhante.Tenha acesso a um universo de oportunidades e serviços personalizados. </p>
            </div>
            <img src="img/iPhone15.png">
        
    </div>

</body>

<footer class="footer">
    <div class="coluna">
        <p class="column-title">Veja também</p>
        <?php
        foreach ($columnLinks1 as $column1) {
            echo '
            <ul class"column-links">
                    <li><a href="' . $column1['link'] . '">' . $column1['nome'] . '</a></li>
                </ul>
            ';
        }
        ?>
    </div>

    <div class="coluna">
        <p class="column-title">Transparência</p>
        <?php
        foreach ($columnLinks2 as $column2) {
            echo '
            <ul class"column-links">
                    <li><a href="' . $column2['link'] . '">' . $column2['nome'] . '</a></li>
                </ul>
            ';
        }
        ?>
    </div>

    <div class="coluna">
        <p class="column-title">Atendimento</p>
        <?php
        foreach ($columnLinks3 as $column3) {
            echo '
            <ul class"column-links">
                    <li><a href="' . $column3['link'] . '">' . $column3['nome'] . '</a></li>
                </ul>
            ';
        }
        ?>
    </div>

    <div class="coluna">
        <p class="column-title">Redes socias</p>
        <?php
        foreach ($columnLinks4 as $column4) {
            echo '
            <ul class"column-links">
                    <li><a href="' . $column4['link'] . '">' . $column4['icon'] . '</a></li>
                </ul>
            ';
        }
        ?>
    </div>
</footer>

</html>