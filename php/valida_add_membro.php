<?php
session_start();

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'bdMuseu';

$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $erros['email'] = 'O email não é válido.';
    }
    if  (!preg_match('/[A-Za-z]/', $dados['senha']) || !preg_match('/[0-9]/', $dados['senha']) || !preg_match('/[^A-Za-z0-9]/', $dados['senha'])) {
        $erros['senha'] = 'A senha precisa conter letras, números e caracteres especiais.';
    }
    if (empty($dados['sobre'])) {
        $erros['sobre'] = 'O campo "Sobre" é obrigatório.';
    }
    if (empty($dados['perfil'])) {
        $erros['perfil'] = 'O perfil é obrigatório.';
    }

    if (empty($erros)) {
        try {
            $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8"; 
            $conexao = new PDO($dsn, $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO membro (nome, email, senha, sobre, perfil) VALUES (:nome, :email, :senha, :sobre, :perfil)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':nome'  => $dados['nome'],
                ':email' => $dados['email'],
                ':senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
                ':sobre' => $dados['sobre'],
                ':perfil'=> $dados['perfil']
            ]);

            $_SESSION['sucesso'] = 'Membro adicionado com sucesso!';
            header('Location: /SitedoMuseu/template/gerenciaMembro.php');
            exit();

        } catch (PDOException $e) {
            $_SESSION['erros']['banco'] = "Erro ao cadastrar: " . $e->getMessage();
            header('Location: /SitedoMuseu/template/addMembro.php');
            exit();
        }
    } else {
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
        header('Location: /SitedoMuseu/template/addMembro.php');
        exit();
    }
}
?> 
