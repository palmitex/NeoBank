<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão
//Arrays Da faq

//Perguntas Gerais
$geral = [
    [
        "pergunta" => " O que é o NeoBank?",
        "resposta" => " O NeoBank é um banco digital inovador, criado para oferecer uma experiência bancária simples, rápida e sem complicações. Ele oferece serviços como contas digitais, cartões de débito e crédito, investimentos, transferências e muito mais, tudo no seu celular, com a segurança e confiabilidade que você precisa.",
    ],

    [
        "pergunta" => " Qual o objetivo do NeoBank?",
        "resposta" => " Oferecer soluções financeiras inovadoras, acessíveis e eficientes, por meio de uma plataforma digital intuitiva, com foco na experiência do cliente. Nosso compromisso é simplificar o dia a dia das pessoas e empresas, promovendo inclusão financeira, transparência e segurança, para que todos possam gerenciar seu dinheiro de forma inteligente, independente e sem complicação.",
    ],



    [
        "pergunta" => "O NeoBank tem agências físicas?",
        "resposta" => "Não. O NeoBank é totalmente digital, o que nos permite oferecer mais praticidade e reduzir custos para você. Todos os nossos serviços estão disponíveis diretamente no site.",

    ],

    [
        "pergunta" => "Como posso entrar em contato com o atendimento?",
        "resposta" => "Você pode entrar em contato com nossa equipe de suporte por meio do nosso e-mail de atendimento. Nossa equipe está disponível 24 horas por dia, 7 dias por semana, para resolver suas dúvidas e necessidades.",

    ],


    [
        "pergunta" => "Quais são os benefícios de ser cliente do NeoBank?",
        "resposta" => "Ao se tornar cliente do NeoBank, você tem acesso a uma série de benefícios, como ausência de tarifas de manutenção de conta, serviços 100% digitais, empréstimos com condições competitivas, investimentos acessíveis, e um cartão com cashback e outras vantagens. Tudo isso com a conveniência de poder gerenciar sua conta a qualquer hora e de qualquer lugar pelo aplicativo.",

    ],

];

//Conta NeoBank
$conta = [
    [
        "pergunta" => "Como abrir uma conta no NeoBank?",
        "resposta" => "Abrir uma conta no NeoBank é simples e rápido. Na página inicial selecione criar conta, preencha seus dados pessoais e envie os documentos solicitados para confirmação. Em poucos minutos sua conta estará pronta para ser utilizada!"
    ],

    [
        "pergunta" => "A conta do NeoBank tem taxas?",
        "resposta" => " Não, a conta do NeoBank é totalmente gratuita. Não cobramos tarifas de manutenção, e você pode fazer transferências e pagamentos sem custos adicionais. Alguns serviços como saques em caixas eletrônicos podem ter taxas específicas, consulte os termos para detalhes.",

    ],
    [
        "pergunta" => "Esqueci minha senha, o que devo fazer?",
        "resposta" => "Se você esqueceu sua senha de acesso ao NeoBank, basta acessar o nosso site oficial e clicar na opção <b>Esqueci minha senha</b>. Você será solicitado a informar seu e-mail cadastrado ou CPF para verificar sua identidade. Em seguida, enviaremos um link para o seu e-mail com instruções para redefinir sua senha. Caso não consiga recuperar sua senha ou tenha problemas durante o processo, entre em contato com o nosso suporte ao cliente para receber assistência e garantir o acesso seguro à sua conta.",

    ],

    [
        "pergunta" => "Como faço para adicionar dinheiro à minha conta?",
        "resposta" => "Você pode adicionar dinheiro à sua conta de diversas formas, como por transferência bancária de outro banco, depósito em lotéricas ou parceiros credenciados, ou recebendo pagamentos via PIX ou TED.",

    ],

    [
        "pergunta" => "Quais tipos de cartões o NeoBank oferece?",
        "resposta" => "O NeoBank oferece um cartão com as funções de débito e crédito. Alem de oferecermos duas linhas de cartão, sendo elas a <b>Linha Básica</b> e a <b>Linha NeoBlack.</b> ",

    ],

    [
        "pergunta" => "Como faço para solicitar um cartão físico?",
        "resposta" => "Após a abertura da conta, você pode solicitar um cartão físico através do site selecionado <b>solicitar cartão</b> e preenchendo o formulário. Ele será enviado para o endereço que você cadastrou.",

    ],

];

//Empréstimos e Investimentos
$inves = [
    [
        "pergunta" => "O NeoBank oferece investimentos?",
        "resposta" => "Sim. Oferecemos opções de investimentos, como CDBs, fundos de investimento, e outras opções com rentabilidade atrativa.",
    ],

    [
        "pergunta" => "Como posso investir pelo NeoBank? ",
        "resposta" => "Abra o aplicativo, acesse a seção de investimentos e escolha a opção que mais se adequa ao seu perfil. O investimento pode ser feito diretamente do seu saldo disponível.",
    ],

    [
        "pergunta" => "Como funciona o processo de solicitação de um empréstimo?",
        "resposta" => "Basta acessar a área de empréstimos no site, preencher suas informações e aguardar a análise de crédito. Se aprovado, o valor será liberado diretamente em sua conta.",
    ],

    [
        "pergunta" => "Como posso acompanhar o desempenho dos meus investimentos?",
        "resposta" => "Você pode acompanhar o desempenho dos seus investimentos diretamente pelo site do NeoBank. Ele oferece relatórios detalhados sobre o rendimento, movimentações e evolução do seu portfólio.",
    ],

    [
        "pergunta" => "O que é a rentabilidade dos investimentos e como ela é calculada?",
        "resposta" => "A rentabilidade dos investimentos é o retorno que você recebe sobre o valor investido, podendo ser positiva (ganhos) ou negativa (perdas). A rentabilidade é calculada com base no tipo de investimento e no seu desempenho durante o período de aplicação.",
    ],
];

//Segurança e Proteção
$seguran = [
    [
        "pergunta" => "O NeoBank é seguro?",
        "resposta" => "Sim, o NeoBank é totalmente seguro. Adotamos as melhores práticas de segurança e tecnologia de ponta para proteger seus dados e transações.Nós também seguimos as regulamentações de segurança e privacidade de dados exigidas pelos órgãos competentes, como a LGPD (Lei Geral de Proteção de Dados), para garantir que suas informações pessoais sejam tratadas com total segurança e confidencialidade.",
    ],

    [
        "pergunta" => "O que devo fazer se receber uma mensagem suspeita ou tentativa de fraude?",
        "resposta" => "Caso receba uma mensagem suspeita ou uma tentativa de fraude, não clique em links e não forneça dados pessoais. Entre em contato imediatamente com o nosso suporte e denuncie o ocorrido. A segurança da sua conta é nossa prioridade.",
    ],

    [
        "pergunta" => "Como posso proteger meus dispositivos contra acessos não autorizados?",
        "resposta" => "Para proteger seus dispositivos, recomendamos que você utilize senhas fortes e únicas, ative o bloqueio de tela (PIN, padrão ou biometria), e mantenha seu dispositivo sempre atualizado com as versões mais recentes do sistema operacional. Além disso, nunca compartilhe seu código de segurança ou senha com outras pessoas.",
    ],

    [
        "pergunta" => "O que devo fazer se eu perder meu celular?",
        "resposta" => " Caso perca seu celular, entre em contato imediatamente com o suporte do NeoBank para bloquear o acesso à sua conta. Além disso, você pode bloquear seu cartão e desativar a conta temporariamente diretamente pelo site. ",
    ],
];
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas frequentes</title>
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../css/global.css">

    <style>
        a {
            text-decoration: none;
        }

        main {
            display: flex;
            justify-content: center;
        }

        /*estilização da div banner e suas imagens*/
        .banner {
            height: 65vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .banner img {
            width: 700px;
        }

        .box-bannerimg{
            width: 50%;
        }
        .box-bannerimg img {
            width: 100%;
            border-radius: 8px;
        }

        .banner-content {
            width: 1000px;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        /*estilização dos textos do banner*/
        .banner-title {
            font-size: 60px;
            margin: 0 0 40px;
            font-weight: bold;
            letter-spacing: 3px;
            text-align: center;
        }

        /* estilização do container "ainda tem dúvidas?" */
        .container-duvidas {
            width: 1000px;
            height: 130px;
            margin: 80px auto 130px;
        }

        .container-duvidas img {
            height: 40px;
            margin-right: 10px;
        }

        .title2-duv {
            font-size: 18px;
            margin: 0;
        }

        .contatos-duv {
            display: flex;
        }

        .group1 {
            margin-right: 45px;
        }

        /* estilização da main */

        .main-container {
            width: 75%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 130px;
        }
        /* estilização da box de categorias */
        .box-categorias {
            position: sticky;
            top: 80px;
            background-color: #3a404a;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            border-radius: 10px;
            width: 250px;
            height: 280px;
            display: flex;
            padding-left: 40px;
            flex-direction: column;
            color: #fff;
            justify-content: center;
            margin-top: 20px;
        }

        .box-categorias a {
            padding-top: 15px;
            font-size: 16px;
            color: #fff;

        }

        .box-categorias a:hover {
            color: #fff;
        }

        .content-c {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 210px;
        }

        .title-box {
            font-weight: bold;
            font-size: 20px;
            margin: 0;
        }

        .categorias {
            color: #3a404a;
            text-decoration: none;

        }


        /* estilização das perguntas */
        .container-perguntas{
            width: 60%;
        }

        .textos,
        .textos1 {
            font-family: Graphik-Medium, Graphik-Regular, "Gotham SSm A", "Gotham SSm B", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .textos {
            margin-top: 70px;
        }

        .icon-perguntas {
            margin-right: 15px;
        }

        /* estilização de cada seção de pergunta */
        #PerguntasGerais, #Conta, #Emprestimos, #Seguranca{
            padding-top: 20px;
        }

        .titleandimg {
            display: flex;
            height: 50px;
            align-items: center;
            margin-bottom: 45px;
        }

        .title-session {
            font-size: 30px;

        }

        .resposta {
            width: 95%;
            font-size: 19px;
            margin: 10px 0 50px;
            color: #80868d;
        }

        .pergunta {
            margin: 10px 0 25px;
            font-size: 21px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .box-perguntas {
            width: 100%;
        }

        .line-img {
            width: 100%;
            margin-bottom: 15px;
        }

        details summary {
            list-style: none;
        }

        details summary::-moz-list-bullet,
        details summary::-webkit-details-marker {
            display: none;
        }

        summary::marker {
            display: none
        }

        summary:after {
            content: "+";
            color: #0088dc;
            float: right;
            font-weight: bold;
            padding: 0;
            text-align: center;
            width: 20px;
            margin-left: 10px;
        }

        details[open] summary:after {
            content: "-";
        }

        .group{
            display: flex;
        }

        /* responsividade */

        @media screen and (max-width: 1000px){
            .box-categorias{
                width: 190px;
            }

            .title-session{
                font-size: 25px;
            }

            .subtitle-duv1{
                display: none;
            }

            .container-duvidas{
                flex-direction: column;
                justify-content: space-evenly;
                height: 150px;
            }
        }

        @media screen and (max-width: 850px){
            .box-categorias{
                display: none;
            }

            .container-perguntas{
                width: 100%;
            }
        }

        @media screen and (max-width: 700px){
            .contatos-duv{
                width: 75%;
                justify-content: space-between;
            }

            .subtitle-duv2{
                display: none;
            }

            .container-duvidas{
                height: 150px;
                justify-content: space-evenly;
            }

            .banner-title{
                font-size: 50px;
            }

            .banner{
                height: 50vh;
            }

            .group{
                flex-direction: column;
            }

            .group1{
                margin: 0;
            }
        }
 
        @media screen and (max-width: 600px){
            .contatos-duv{
                height: 150px;
                width: max-content;
                align-items: center;
                flex-direction: column;
            }

            .container-duvidas{
                height: 250px;
                justify-content: space-evenly;
            }
        }

        @media screen and (max-width: 425px){
            .banner-title{
                font-size: 40px;
            }

            .banner{
                height: 35vh;
            }

            .container-duvidas{
                width: 75%;
            }

            .container-duvidas img{
                height: 30px;
            }

            .group{
                flex-direction: row;
                align-items: center;
            }

            .contatos-duv{
                height: 100px;
            }
        }

        @media screen and (max-width: 320px) {
            .banner-title{
                font-size: 30px;
            }

            .banner{
                height: 30vh;
            }

            .container-duvidas{
                margin-top: 40px;
                margin-bottom: 60px
            }

            .title2-duv{
                font-size: 16px;
            }

            .container-duvidas{
                height: 180px;
            }

            .title-session{
                font-size: 20px;
            }

            .box-perguntas{
                font-size: 18px;
            }
}
    </style>
</head>
<?php require_once 'navbar.php'; ?>
<body>

    <div class="banner">
        <div class="banner-content">
            <p class="banner-title">Como podemos<br>te ajudar?</p>
            <div class="box-bannerimg">
                <img src="../img/img-banner-faq.jpg">
            </div>
        </div>
    </div>

    <div class="container-duvidas">
        <div>
            <p class="title-duv">Ainda tem dúvidas?</p>
            <p class="subtitle-duv1">Estamos aqui para ajudar</p>
        </div>
        <div class="contatos-duv">
            <div class="group">
            <img src="../img/phone-icon.svg">
            <div class="group1">
                <a href="tel:08001234567">
                    <p class="title2-duv">0800 123 4567</p>
                </a>
                <p class="subtitle-duv2">Suporte via telefone</p>
            </div>
            </div>

            <div class="group">
            <img src="../img/email-icon.svg">
            <div class="group1">
                <a href="mailto:suporte@neobank.com">
                    <p class="title2-duv">suporte@neobank.com</p>
                </a>
                <p class="subtitle-duv2">Suporte via E-mail</p>
            </div>
            </div>
        </div>
    </div>

    <main>
        <div class="main-container">

            <div class="box-categorias">
                <div class="content-c">
                    <p class="title-box">Categorias</p>
                    <a href="#PerguntasGerais" class="categorias">Perguntas gerais</a>
                    <a href="#Conta" class="categorias">Conta</a>
                    <a href="#Emprestimos" class="categorias">Empréstimos e investimentos</a>
                    <a href="#Seguranca" class="categorias">Segurança e proteção</a>
                </div>
            </div>

            <div class="container-perguntas">
                <!--Perguntas Gerais-->
                <div id="PerguntasGerais" class="textos1">
                    <div class="titleandimg">
                        <img src="../img/perg-gerais.svg" class="icon-perguntas">
                        <h1 class="title-session">Perguntas Gerais</h1>
                    </div>

                    <?php

                    foreach ($geral as $gerais) {
                        print '
                    <details>
                    <summary class="pergunta"><div class="box-perguntas">' . $gerais['pergunta'] . '</div></summary>
                    <div class="resposta">' . $gerais['resposta'] . '</div>
                    </details>
                    <img src="../img/line900px.svg" class="line-img">
                    ';
                    }
                    ?>
                </div>

                <!--Perguntas Conta-->
                <div id="Conta" class="textos">
                    <div class="titleandimg">
                        <img src="../img/user-icon.svg" class="icon-perguntas">
                        <h1 class="title-session">Conta NeoBank</h1>
                    </div>
                    <?php

                    foreach ($conta as $contas) {
                        print '
                    <details>
                    <summary class="pergunta"><div class="box-perguntas">' . $contas['pergunta'] . '</div></summary>
                    <div class="resposta">' . $contas['resposta'] . '</div>
                    </details>
                    <img src="../img/line900px.svg" class="line-img">

                    ';
                    }
                    ?>
                </div>

                <!--Empréstimos e Investimentos-->
                <div id="Emprestimos" class="textos">
                    <div class="titleandimg">
                        <img src="../img/emp-icon.svg" class="icon-perguntas">
                        <h1 class="title-session">Empréstimos e Investimentos</h1>
                    </div>
                    <?php

                    foreach ($inves as $invest) {
                        print '
                    <details>
                    <summary class="pergunta"><div class="box-perguntas">' . $invest['pergunta'] . '</div></summary>
                    <div class="resposta">' . $invest['resposta'] . '</div>
                    </details>
                    <img src="../img/line900px.svg" class="line-img">

                    ';
                    }
                    ?>
                </div>

                <!--Segurança e Proteção-->
                <div id="Seguranca" class="textos">
                    <div class="titleandimg">
                        <img src="../img/seguranca-icon.svg" class="icon-perguntas">
                        <h1 class="title-session">Segurança e Proteção</h1>
                    </div>
                    <?php

                    foreach ($seguran as $seguranca) {
                        print '
                    <details>
                    <summary class="pergunta"><div class="box-perguntas">' . $seguranca['pergunta'] . '</div></summary>
                    <div class="resposta">' . $seguranca['resposta'] . '</div>
                    </details>
                    <img src="../img/line900px.svg" class="line-img">

                    ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>


    <!-- javascript simples para mostrar respostas ao clicar nas perguntas -->
    <script>
        document.querySelectorAll('.pergunta').forEach((question) => {
            question.addEventListener('click', () => {
                question.classList.toggle('active');
            });
        });
    </script>

    <!-- javascript para deixar a rolagem de tela mais suave quando links de ancôra forem clicados -->
    <script>
        document.querySelectorAll('.box-categorias a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>

</body>

<?php require_once './footer.php'; ?>

</html>