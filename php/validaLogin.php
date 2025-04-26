<?php
$emailCorreto = 'admin@museu.com';
$senhaCorreta = '123456';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($email === $emailCorreto && $senha === $senhaCorreta) {
    header('Location: gerencia.html');
    exit();
} else {
    header('Location: /SitedoMuseu/template/login.php?erro=1');
    exit();
}
?>