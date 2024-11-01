<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Lê o histórico de transações
$historico = file_exists("historico.txt") ? file("historico.txt") : [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Histórico de Transações</title>
    <link rel="stylesheet" href="css/historico.css">
</head>
<body>
    <div class="container">
        <h1>Histórico de Transações</h1>

        <?php if (!empty($historico)): ?>
            <ul>
                <?php foreach ($historico as $transacao): ?>
                    <li><?php echo htmlspecialchars($transacao); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Não há transações registradas.</p>
        <?php endif; ?>

        <a href="index.php" class="button">Voltar ao Menu Principal</a>
    </div>
</body>
</html>