<?php
session_start();
require_once '../bd/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    $_SESSION['sucesso'] = "ID inválido.";
    header('Location: /SitedoMuseu/template/gerenciaMembro.php');
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM membro WHERE id = ?");
    $stmt->execute([$id]);

    
} catch (PDOException $e) {
   
}

header('Location: /SitedoMuseu/template/gerenciaMembro.php');
exit();
