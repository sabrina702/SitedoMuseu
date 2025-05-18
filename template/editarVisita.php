<?php
// editarVisita.php

require_once '../bd/conexao.php'; // conexão PDO em $pdo

function atualizarSituacao($pdo, $id, $novaSituacao) {
    $situacoesValidas = ['Nova', 'Em análise', 'Agendado', 'Concluído'];
    if ($id > 0 && in_array($novaSituacao, $situacoesValidas)) {
        $stmt = $pdo->prepare("UPDATE solicitacao SET situacao = ? WHERE id = ?");
        return $stmt->execute([$novaSituacao, $id]);
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);
    $novaSituacao = $_POST['situacao'] ?? '';

    if (atualizarSituacao($pdo, $id, $novaSituacao)) {
       echo "OK";
        exit();
    } else {
        echo "Erro ao atualizar a situação da solicitação.";
    }
}
?>
