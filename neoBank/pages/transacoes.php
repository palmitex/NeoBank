<?php
// Desativar exibição de erros
error_reporting(0);
ini_set('display_errors', 0);
session_start(); // Inicia a sessão

//Arrays de Tipos de Transações

$Tipos = [
    //Arrys de transferência
    [
        "classe"=> "transferir",
        "classe2"=> "notificacoes-img",
        "titulo" => "Transferências",
        "subtitulo" => "Mande e receba seu dinheiro instantaneamente",
        "texto" => "Com o NeoBank, suas transferências são realizadas com agilidade e segurança, proporcionando tranquilidade e facilidade para que você possa focar no que realmente importa. Experimente a eficiência de nossos serviços e veja como é simples gerenciar suas finanças com a gente.",
        "icon" => "icone1.svg",
        "beneficio1" => "Transferências gratuitas",
        "beneficio2" => "Proteção contra fraudes",
        "page" => "Fazer transferência ",
        "link" => "pagamento.php",
        "seta" => "seta.svg",
        "imagem" => "notificacoes.svg",
    ],

      //Arrys de saque
      [
        "classe"=> "saque",
        "classe2"=> "saque-img",
        "titulo" => "Saque",
        "subtitulo" => "Retire seu dinheiro quando e onde precisar",
        "texto" => "Seja em uma emergência ou em suas atividades diárias, estamos aqui para garantir que você possa contar com a facilidade de realizar saques em qualquer lugar e a qualquer momento.",
        "icon" => "check-t-icon.svg",
        "beneficio1" => "Vasta rede de caixas eletrônicos parceiros",
        "beneficio2" => "Saque rápido",
        "page" => "Fazer saque",
        "link" => "saque.php",
        "seta"=> "seta.svg",
        "imagem" => "dinheiro.svg",
    ],

      //Arrys de empréstimo
     [
        "classe"=> "transferir",
        "classe2"=> "celular-aling-img",
        "titulo" => "Empréstimo",
        "subtitulo" => "Financie seus sonhos com nossos empréstimos",
        "texto" => "Seja para investir em um novo projeto, consolidar dívidas ou fazer aquela compra importante, nossos empréstimos estão aqui para dar o suporte financeiro que você precisa de forma ágil e eficiente.",
        "icon" => "icone1.svg",
        "beneficio1" => "Taxas acessíveis",
        "beneficio2" => "Sem burocracia",
        "page" => "Por que fazer um empréstimo com o NeoBank?",
        "link" => "emprestimopage.php",
        "seta"=> "seta.svg",
        "imagem" => "celular.svg",
    ],
    
    //Arrys de depósito
    [
        "classe"=> "saque",
        "classe2"=> "deposito-img",
        "titulo" => "Depósito",
        "subtitulo" => "Guardar seus recursos nunca foi tão fácil",
        "texto" => "Deposite seus recursos de forma prática e segura, facilitando seu dia a dia. Com a gente, você terá sempre a confiança de que seu dinheiro está em boas mãos, permitindo que você se concentre no que realmente importa sem preocupações financeiras.",
        "icon" => "check-t-icon.svg",
        "beneficio1" => "Total controle de suas finanças",
        "beneficio2" => "Segurança reforçada",
        "page" => "Fazer depósito",
        "link" => "deposito.php",
        "seta"=> "seta.svg",
        "imagem" => "moedas.svg",
    ],


];

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/transacoes.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">
    <title>Transações</title>
</head>

<body>
<?php require_once 'navbar.php' ?>

    <main>
        <!--Banner Inicial-->
        <section class="banner">
            <div class="textos-ban">
                <h1>Transações</h1>
                <p class="p-session">Realize suas transações de forma rápida e segura, a qualquer hora e em qualquer lugar.
            </div>
            <div class="banner-img">
            <img src="../img/calculadora.svg">
</div>
        </section>

        <!--Tipos de Transações-->
        <section class="transacoes">


            <?php
            foreach ($Tipos as $tipo) {
                print '
        <div class="' . $tipo['classe'] . '">
            <div class="container-transf">
            <div class="transferir-aling">

                <h1>' . $tipo['titulo'] . '</h1>
                <h2>' . $tipo['subtitulo'] . '</h2>
                <p>' . $tipo['texto'] . '</p>

                <div class="beneficios">

                    <div class="beneficios-aling">
                        <img src="../img/' . $tipo['icon'] . '" alt="">
                        <h3>' . $tipo['beneficio1'] . '</h3>
                    </div>

                    <div class="beneficios-aling">
                    <img src="../img/' . $tipo['icon'] . '">
                    <h3>' . $tipo['beneficio2'] . '</h3>
                    </div>
                </div>

                <div class="button-transf">
                    <a href="' . $tipo['link'] . '"><button class="button-saibamais1">' . $tipo['page'] . '
                    <img src="../img/' . $tipo['seta'] . '">
                     </button>
                     </a>

                </div>

            </div>

            <div class="img-secao">
            <img src="../img/' . $tipo['imagem'] . '" class="' . $tipo['classe2'] . '">
            </div>
            </div>
        </div>';
            }
            ?>
        </section>


    </main>
</body>

<?php require_once './footer.php'; ?>

</html>