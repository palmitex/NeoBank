<?php

// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

?>
 
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav Bar NeoBank</title>
    <link rel="stylesheet" href="../css/global.css">
 
    <style>
        /*estilização da navbar*/
        nav {
            width: 100%;
            box-shadow: 0px 10px 10px -3px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            display: flex;
            align-items: center;
            height: 70px;
        }
 
        nav li {
            display: inline-block;
        }
 
        nav li a {
            display: inline-block;
            color: #000000;
            text-decoration: none;
            padding: 20px;
        }
 
        .dropdown p {
            text-align: center;
            font-size: 16px;
            margin: 0;
            padding-top: 10px;
            padding-bottom: 10px;
        }
 
        .ulnav-right {
            display: flex;
            justify-content: flex-end;
            width: 45%;
            align-items: center;
        }
 
        .dropdown-menu a:hover {
            color: #0088dc;
            transition: all 0.3s ease-in-out;
            background-color: #F1F6FA;
        }
 
        .dropdown {
            width: 220px;
            padding: 30px 0;
        }
 
        .dropdown-menu a {
            margin: 0;
        }
 
        .dropdown:hover .dropdown-menu {
            display: block;
        }
 
        .logonav {
            height: 20px;
            margin: 0 50px;
        }
 
        .login-btn {
            color: #08c;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;        
        }
 
        .dropdown-menu {
            position: absolute;
            display: none;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }
 
        .dropdown-menu a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            display: block;
        }
        .iconuser {
            width: 20px;
            padding: 20px;
            border-radius:18px;
            color: #0088cc;
            background-color: #F1F6FA;
        }
 
     .menu-toggle{
            display: none;
        }
 
        @media screen and (max-width: 1600px) {
            .ulnav{
                width: 1500px;
            }
        }
 
        /* Menu responsivo */
        @media screen and (max-width: 1024px) {
            nav .ulnav {
                display: none;
                width: 100%;
                position: absolute;
                top: 70px;
                left: 0;
                background-color: white;
                flex-direction: column;
                box-shadow: 0px 10px 10px -3px rgba(0, 0, 0, 0.1);
                z-index: 1;
            }
 
            nav .ulnav li {
                width: 100%;
                text-align: center;
                margin: 10px 0;
            }
 
            nav .ulnav-right {
                display: none; /* Ocultar o login na versão normal */
            }
 
            nav .ulnav.show {
                display: flex;
            }
 
            .menu-toggle {
                display: block;
                background-color: #0088cc;
                padding: 10px;
                border: none;
                color: white;
                font-size: 18px;
                position: absolute;
                right:10px;
            }
 
            .menu-toggle:focus {
                outline: none;
            }
 
            /* Alterar para que os itens 'Para você' e 'O Neobank' apareçam como botões */
            nav .dropdown p {
                cursor: pointer;
                margin: 0;
                padding: 10px;
                background-color: #0088cc;
                color: white;
                border-radius: 5px;
                text-align: center;
            }
 
            .dropdown-menu {
                position: relative;
                box-shadow: none;
                display: block;
                background-color: #fff;
                border-radius: 0;
                margin-top: 5px;
            }
 
            .dropdown a {
                text-align: center;
            }
 
            .dropdown-menu a {
                padding: 10px;
                border-top: 1px solid #eee;
                text-align: center;
            }
 
            .dropdown-menu a:hover {
                background-color: #f0f0f0;
            }
 
            /* Login dentro do menu hamburguer em telas pequenas */
            nav .ulnav li:last-child {
                display: block;
                text-align: center;
                margin-top: 20px;
            }
 
            nav .ulnav li:last-child a {
                text-decoration: none;
                font-size: 16px;
            }
       
        }
 
    </style>
</head>
 
<body>
    <nav class="navbar">
        <a href="index.php">
            <img src="../img/nb-logo.svg" class="logonav">
        </a>
 
        <!-- Botão de menu (hamburguer) para telas pequenas -->
        <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
 
        <ul class="ulnav">
            <li><a href="index.php">Página inicial</a></li>
            <li class="dropdown">
                <p>Para você</p>
                <div class="dropdown-menu">
                    <a href="transacoes.php">Transações</a>
                    <a href="cards.php">Cartões</a>
                    <a href="investimentos.php">Investimentos</a>
                    <a href="historico.php">Histórico</a>
                </div>
            </li>
            <li class="dropdown">
                <p>O Neobank</p>
                <div class="dropdown-menu">
                    <a href="sobrenos.php">Sobre nós</a>
                    <a href="politicas.php">Política de privacidade</a>
                </div>
            </li>
            <li class="nav-link"><a href="faq.php">Perguntas frequentes</a></li>
        </ul>
 
        <!-- Login dentro do menu hambúrguer em telas pequenas -->
        <ul class="ulnav-right">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <li class="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="iconuser"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"/></svg>
                    <div class="dropdown-menu">
                        <p><?php echo $_SESSION['nome']; ?></p>
                        <a href="logout.php">Sair</a>
                    </div>
                </li>
            <?php else: ?>
                <li class="nav-link"><a href="login.php" class="login-btn"><button class="button-saibamais">Login <img src="../img/setaDiagonal.png"></button></a></li>
            <?php endif; ?>
        </ul>
    </nav>
 
    <script>    
   function toggleMenu() {
    const nav = document.querySelector('.ulnav');
   
    nav.classList.toggle('show');
}
       
    </script>
</body>
</html>