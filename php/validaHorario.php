<?php
session_start();

$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $dados['diaSemana'] = $_POST['diaSemana'] ?? '';
    $dados['horaAbertura'] = $_POST['horaAbertura'] ?? '';
    $dados['horaFechamento'] = $_POST['horaFechamento'] ?? '';
    
    // Validações
    if (empty($dados['diaSemana'])) {
        $erros['diaSemana'] = 'O dia da semana é obrigatório.';
    }
    if (empty($dados['horaAbertura'])) {
        $erros['horaAbertura'] = 'O horário de abertura é obrigatório.';
    }
    if (empty($dados['horaFechamento'])) {
        $erros['horaFechamento'] = 'O horário de fechamento é obrigatório.';
    }

    if (empty($erros)) {
        $_SESSION['sucesso'] = "Edição realizada com sucesso!";
        header('Location: /SitedoMuseu/template/gerenciaHorario.php');
        exit();
    }

    // Se tiver erro, salva os dados e erros
    $_SESSION['erros'] = $erros;
    $_SESSION['dados'] = $dados;

    header('Location: /SitedoMuseu/template/gerenciaHorario.php');
    exit();
}
?>
