<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados enviados
    $data = json_decode(file_get_contents('php://input'), true);
    $novoInvestimento = $data['investimento'];

    // Atualiza o arquivo de investimento
    file_put_contents("investimento.txt", $novoInvestimento);

    echo json_encode(['message' => 'Investimento atualizado com sucesso']);
} else {
    echo json_encode(['message' => 'Método não permitido']);
}
?>
