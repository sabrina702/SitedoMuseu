<?php
session_start();

// E-mail e senha corretos para validação
$emailCorreto = 'admin@museu.com';
$senhaCorreta = 'Admin@123';

$erros = [];
$erroLogin = '';  // Variável específica para o erro de login

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Verificar se o e-mail e a senha estão corretos primeiro
    if ($email === $emailCorreto && $senha === $senhaCorreta) {
        $_SESSION['usuario'] = $email;
        header('Location: /SitedoMuseu/template/gerencia.php');
        exit();
    } else {
        // Se o login falhar, armazena a mensagem de erro
        $erroLogin = 'E-mail ou senha incorretos.';
    }

    // Se o login falhar, prosseguir com as outras validações
    if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'O e-mail informado é inválido.';
    }

    if  (!preg_match('/[A-Za-z]/', $senha) || !preg_match('/[0-9]/', $senha) || !preg_match('/[^A-Za-z0-9]/', $senha)) {
        $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
    }

    // Armazenar os erros e os dados na sessão
    $_SESSION['erros'] = $erros;
    $_SESSION['erroLogin'] = $erroLogin;  // Salva a mensagem de erro de login
    $_SESSION['dados'] = ['email' => $email, 'senha' => $senha];

    // Redireciona de volta para o login
    header('Location: /SitedoMuseu/template/login.php');
    exit();
}
