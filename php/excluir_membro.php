<?php
    session_start();
    require_once '../bd/conexao.php';
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /SitedoMuseu/template/login.php');
        exit();
    }

    if ($_SESSION['usuario_perfil'] !== 'Coordenador(a) do Museu') {
        $_SESSION['sucesso'] = "Você não tem permissão para excluir membros.";
        header('Location: /SitedoMuseu/template/gerenciaMembro.php');
        exit();
    }
    $id = $_GET['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        $_SESSION['sucesso'] = "ID inválido.";
        header('Location: /SitedoMuseu/template/gerenciaMembro.php');
        exit();
    }
    
    if ((int)$id === (int)$_SESSION['usuario_id']) {
        $_SESSION['sucesso'] = "Você não pode se autoexcluir.";
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
?>