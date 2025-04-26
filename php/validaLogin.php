<?php
session_start(); 

$emailCorreto = 'admin@museu.com';
$senhaCorreta = 'Admin@123'; 

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

function senhaForte($senha) {
    return preg_match('/[A-Za-z]/', $senha) && preg_match('/[0-9]/', $senha) && preg_match('/[^A-Za-z0-9]/', $senha);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /SitedoMuseu/template/login.php?erro=1');
    exit();
}

if (!senhaForte($senha)) {
    header('Location: /SitedoMuseu/template/login.php?erro=1');
    exit();
}

if ($email === $emailCorreto && $senha === $senhaCorreta) {
    $_SESSION['usuario'] = $email;
    header('Location: /SitedoMuseu/template/gerencia.php');
    exit();
} else {
    header('Location: /SitedoMuseu/template/login.php?erro=1');
    exit();
}
?>
