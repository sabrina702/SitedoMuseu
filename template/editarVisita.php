<?php

session_start();
require_once '../bd/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Sessão expirada. Faça login novamente.";
    exit();
}

$idSolicitacao = intval($_POST['id'] ?? 0);
$novaSituacao = $_POST['situacao'] ?? '';
$idMembroLogado = $_SESSION['usuario_id'];

$situacoesValidas = ['Nova', 'Em análise', 'Agendado', 'Concluído'];

if ($idSolicitacao <= 0 || !in_array($novaSituacao, $situacoesValidas)) {
    echo "Dados inválidos.";
    exit();
}

$stmt = $pdo->prepare("SELECT id_membro FROM solicitacao WHERE id = ?");
$stmt->execute([$idSolicitacao]);
$membroAtual = $stmt->fetchColumn();


if ($membroAtual === null) {
    $stmt = $pdo->prepare("UPDATE solicitacao SET situacao = ?, id_membro = ? WHERE id = ?");
    $sucesso = $stmt->execute([$novaSituacao, $idMembroLogado, $idSolicitacao]);
} elseif ($membroAtual == $idMembroLogado) {
    $stmt = $pdo->prepare("UPDATE solicitacao SET situacao = ? WHERE id = ?");
    $sucesso = $stmt->execute([$novaSituacao, $idSolicitacao]);
} else {
    echo "Você não tem permissão para alterar esta solicitação.";
    exit();
}

if ($sucesso) {
    echo "OK";
    exit();
} else {
    echo "Erro ao atualizar a situação.";
}