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
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/politicas.css">
    <link rel="shortcut icon" href="../img/nb-logo.svg" type="image/x-icon">

    <title>Política de Privacidade - NeoBank</title>
    <style>
        @media screen and (max-width: 480px) {  
    .container-duvidas {
        width: 100%;
        flex-direction: column;
    }
    .title-duv {
        padding-top: 10px;
        font-size: 16px;
        padding-left: 10px;
    }
    .subtitle-duv1 {
        font-size: 12px;
        padding-left: 15px;
        padding-right: 5px;
    }
    .title2-duv {
        font-size: 12px;
        padding-left: 10px;
    }
    .subtitle-duv2 {
        font-size: 12px;
        padding-left: 10px;
        width: 100px;
    }

}
    </style>
</head>

<body>
    <?php require_once 'navbar.php' ?>

    <main>
        <section>
            <div class="banner">
                <div class="banner-content">
                <p class="banner-text">Aviso de Privacidade</p>
            </div>
            </div>

            <div class="container-polit">
                <div class="session">
                    <h1>Política de Privacidade</h1>
                    <p>A sua privacidade é importante para nós. É política do NeoBank respeitar e proteger a sua privacidade em relação a qualquer informação que possamos coletar durante a sua experiência conosco. Esta política descreve como coletamos, utilizamos, armazenamos e protegemos as suas informações pessoais.</p>
                </div>

                <div class="session">
                    <h2>Informações que coletamos</h2>
                    <p>Coletamos diferentes tipos de informações, incluindo:</p>
                    <ul>
                        <li><img src="../img/icone1.svg">Informações de identificação, como nome completo e CPF.</li>
                        <li><img src="../img/icone1.svg">Informações de contato, como e-mail e telefone.</li>
                        <li><img src="../img/icone1.svg">Informações de acesso, como credenciais de login e histórico de login.</li>
                        <li><img src="../img/icone1.svg">Informações bancárias e transacionais, necessárias para fornecer nossos serviços financeiros.</li>
                        <li><img src="../img/icone1.svg">Preferências e histórico de navegação em nosso site para personalizar sua experiência.</li>
                    </ul>
                    <p>Essas informações podem ser coletadas diretamente de você ou de fontes autorizadas, e são tratadas com o mais alto nível de segurança.</p>
                </div>

                <div class="session">
                    <h2>Base Legal para Coleta de Dados</h2>
                    <p>Nossa coleta de dados é baseada nas seguintes justificativas legais:</p>
                    <ul>
                        <li><img src="../img/icone1.svg">Execução de um contrato para gerenciar sua conta e fornecer serviços financeiros.</li>
                        <li><img src="../img/icone1.svg">Consentimento para atividades como envio de marketing, quando aplicável.</li>
                        <li><img src="../img/icone1.svg">Cumprimento de obrigações legais e regulatórias que exigem a coleta e retenção de dados.</li>
                        <li><img src="../img/icone1.svg">Interesses legítimos para aprimorar a segurança e a experiência do usuário.</li>
                    </ul>
                </div>

                <div class="session">
                    <h2>Armazenamento e Retenção das Informações</h2>
                    <p>As informações são armazenadas em servidores seguros com protocolos de criptografia e controle de acesso restrito. Mantemos as informações pelo tempo necessário para cumprir os propósitos descritos nesta política, respeitando a legislação aplicável. Ao final do período de retenção, os dados são excluídos de forma segura.</p>
                </div>

                <div class="session">
                    <h2>Uso das informações</h2>
                    <p>Utilizamos suas informações para:</p>
                    <ul>
                        <li><img src="../img/icone1.svg">Gerenciar sua conta e fornecer suporte ao cliente.</li>
                        <li><img src="../img/icone1.svg">Enviar notificações sobre atualizações em nossos serviços e segurança da conta.</li>
                        <li><img src="../img/icone1.svg">Personalizar sua experiência com base no histórico de uso.</li>
                        <li><img src="../img/icone1.svg">Realizar análises e melhorar nossos serviços e segurança.</li>
                        <li><img src="../img/icone1.svg">Cumprir exigências legais e regulatórias.</li>
                    </ul>
                </div>

                <div class="session">
                    <h2>Segurança da Informação</h2>
                    <p>Adotamos medidas técnicas, administrativas e físicas para proteger suas informações pessoais. Essas medidas incluem criptografia, monitoramento de acesso e auditorias regulares de segurança. Embora utilizemos tecnologias avançadas, ressaltamos que nenhum sistema é infalível. Em caso de incidente de segurança, você será notificado conforme a legislação aplicável.</p>
                </div>

                <div class="session">
                    <h2>Compartilhamento de informações</h2>
                    <p>Não compartilhamos suas informações com terceiros sem o seu consentimento, exceto nos seguintes casos:</p>
                    <ul>
                        <li><img src="../img/icone1.svg">Para cumprimento de obrigações legais ou regulatórias.</li>
                        <li><img src="../img/icone1.svg">Para proteção de direitos e segurança do NeoBank e de seus clientes.</li>
                        <li><img src="../img/icone1.svg">Para provedores de serviços que atuam em nosso nome, sob acordo de confidencialidade.</li>
                    </ul>
                </div>

                <div class="session">
                    <h2>Cookies e Tecnologias de Rastreamento</h2>
                    <p>Utilizamos cookies e tecnologias similares para melhorar a sua experiência em nosso site. Os cookies são pequenos arquivos armazenados no seu dispositivo e usados para identificar suas preferências e otimizar nossos serviços. Você pode desativar os cookies no seu navegador, mas isso pode impactar negativamente a experiência de navegação.</p>
                </div>

                <div class="session">
                    <h2>Transferência Internacional de Dados</h2>
                    <p>Em algumas situações, suas informações podem ser transferidas para servidores localizados fora do Brasil. Nesses casos, tomamos as medidas adequadas para garantir que seus dados pessoais recebam o mesmo nível de proteção, independentemente do local de processamento.</p>
                </div>

                <div class="session">
                    <h2>Direitos dos Usuários</h2>
                    <p>Você possui direitos relacionados às suas informações pessoais, incluindo:</p>
                    <ul>
                        <li><img src="../img/icone1.svg">Acessar suas informações pessoais.</li>
                        <li><img src="../img/icone1.svg">Solicitar a correção de dados incorretos ou incompletos.</li>
                        <li><img src="../img/icone1.svg">Solicitar a exclusão de suas informações pessoais, exceto quando a retenção for exigida por lei.</li>
                        <li><img src="../img/icone1.svg">Restringir ou limitar o uso de suas informações.</li>
                        <li><img src="../img/icone1.svg">Retirar o consentimento a qualquer momento, quando aplicável.</li>
                        <li><img src="../img/icone1.svg">Receber uma cópia eletrônica dos seus dados em um formato comum, quando tecnicamente viável.</li>
                    </ul>
                </div>

                    <div class="container-duvidas">
                        <div class="cntt-content">
                            <h2 class="title-duv">Contato</h2>
                            <p class="subtitle-duv1">Se você tiver dúvidas sobre esta Política de Privacidade, ou quiser exercer seus direitos, entre em contato conosco:</p>
                        </div>
                        <div class="email-content">
                            <div class="email-title">
                                <img src="../img/email-icon.svg">
                                <p class="title2-duv">suporte@neobank.com</p>
                            </div>


                            <a href="mailto:support@neobank.com" class="a-email"><button class="btn-azul">Enviar E-mail</button></a>
                        </div>
                    </div>
            </div>
            </div>
        </section>
    </main>

</body>
<?php require_once './footer.php'; ?>

</html>