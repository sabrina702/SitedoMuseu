<?php
session_start();
require_once '../bd/conexao.php';

$erros = [];
$erroLogin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação básica
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'O e-mail informado é inválido.';
    }
    if (empty($senha)) {
        $erros['senha'] = 'A senha é obrigatória.';
    }

    if (empty($erros)) {
        $stmt = $pdo->prepare("SELECT * FROM membro WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login ok
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_perfil'] = $usuario['perfil'];
            $_SESSION['usuario_email'] = $usuario['email'];

            header('Location: /SitedoMuseu/template/gerencia.php');
            exit();
        } else {
            $erroLogin = 'E-mail ou senha incorretos.';
        }
    }

    $_SESSION['erros'] = $erros;
    $_SESSION['erroLogin'] = $erroLogin;
    $_SESSION['dados'] = ['email' => $email];

    header('Location: /SitedoMuseu/template/login.php');
    exit();
}
?>
