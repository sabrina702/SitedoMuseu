<?php
session_start();

$emailCorreto = 'admin@museu.com';
$senhaCorreta = 'Admin@123';

$erros = [];
$erroLogin = '';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email === $emailCorreto && $senha === $senhaCorreta) {
        $_SESSION['usuario'] = $email;
        header('Location: /SitedoMuseu/template/gerencia.php');
        exit();
    } else {
        $erroLogin = 'E-mail ou senha incorretos.';
    }

    if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'O e-mail informado é inválido.';
    }

    if  (!preg_match('/[A-Za-z]/', $senha) || !preg_match('/[0-9]/', $senha) || !preg_match('/[^A-Za-z0-9]/', $senha)) {
        $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
    }

    $_SESSION['erros'] = $erros;
    $_SESSION['erroLogin'] = $erroLogin;  
    $_SESSION['dados'] = ['email' => $email, 'senha' => $senha];

    
    header('Location: /SitedoMuseu/template/login.php');
    exit();
}
