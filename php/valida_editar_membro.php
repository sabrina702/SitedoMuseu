<?php
session_start();

$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $dados['nome'] = $_POST['nome'] ?? '';
    $dados['email'] = $_POST['email'] ?? '';
    $dados['sobre'] = $_POST['sobre'] ?? '';
    $dados['perfil'] = $_POST['perfil'] ?? '';

    // Validações
    if (empty($dados['nome'])) {
        $erros['nome'] = 'O nome é obrigatório.';
    }
    if (empty($dados['email'])) {
        $erros['email'] = 'O email é obrigatório.';
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'O email não é válido.';
    }
    if (empty($dados['sobre'])) {
        $erros['sobre'] = 'O campo "Sobre" é obrigatório.';
    }
    if (empty($dados['perfil'])) {
        $erros['perfil'] = 'O perfil é obrigatório.';
    }

    // Se não houver erros, processa os dados
    if (empty($erros)) {
        $_SESSION['sucesso'] = 'Membro alterado com sucesso!';
        header('Location: /SitedoMuseu/template/editaMembro.php');
        exit();
    }

    // Caso haja erros, armazena na sessão e redireciona de volta ao formulário
    $_SESSION['erros'] = $erros;
    $_SESSION['dados'] = $dados;
    header('Location: /SitedoMuseu/template/editaMembro.php');
    exit();
}
?>
