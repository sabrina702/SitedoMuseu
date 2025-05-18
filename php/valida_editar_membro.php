<?php
session_start();
require_once '../bd/conexao.php';

$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados['id'] = $_POST['id'] ?? '';
    $dados['nome'] = $_POST['nome'] ?? '';
    $dados['email'] = $_POST['email'] ?? '';
    $dados['senha'] = $_POST['senha'] ?? '';
    $dados['sobre'] = $_POST['sobre'] ?? '';    
    $dados['perfil'] = $_POST['perfil'] ?? '';

    if (empty($dados['nome'])) {
        $erros['nome'] = 'O nome é obrigatório.';
    }

    if (empty($dados['email'])) {
        $erros['email'] = 'O email é obrigatório.';
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'Email inválido.';
    }

    if (!empty($dados['senha']) && 
        (!preg_match('/[A-Za-z]/', $dados['senha']) || 
         !preg_match('/[0-9]/', $dados['senha']) || 
         !preg_match('/[^A-Za-z0-9]/', $dados['senha']))) {
        $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
    }

    if (empty($dados['sobre'])) {
        $erros['sobre'] = 'O campo "Sobre" é obrigatório.';
    }

    if (empty($dados['perfil'])) {
        $erros['perfil'] = 'O perfil é obrigatório.';
    }

    if (!empty($erros)) {
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
        header("Location: /SitedoMuseu/template/editaMembro.php?id=" . $dados['id']);
        exit();
    }

    try {
        if (!empty($dados['senha'])) {
            $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
            $sql = "UPDATE membro SET nome = ?, email = ?, senha = ?, sobre = ?, perfil = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $dados['nome'],
                $dados['email'],
                $senhaHash,
                $dados['sobre'],
                $dados['perfil'],
                $dados['id']
            ]);
        } else {
            $sql = "UPDATE membro SET nome = ?, email = ?, sobre = ?, perfil = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $dados['nome'],
                $dados['email'],
                $dados['sobre'],
                $dados['perfil'],
                $dados['id']
            ]);
        }

        $_SESSION['sucesso'] = "Membro atualizado com sucesso!";
        header("Location: /SitedoMuseu/template/editaMembro.php?id=" . $dados['id']);
        exit();
    } catch (PDOException $e) {
        $erros['geral'] = "Erro ao atualizar: " . $e->getMessage();
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
        header("Location: /SitedoMuseu/template/editaMembro.php?id=" . $dados['id']);
        exit();
    }
}
?>
