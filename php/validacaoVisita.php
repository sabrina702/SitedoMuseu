<?php
session_start();

$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $dados['nome_responsavel'] = $_POST['nome_responsavel'] ?? '';
    $dados['nome_escola'] = $_POST['nome_escola'] ?? '';
    $dados['dia_pretendido'] = $_POST['dia_pretendido'] ?? '';
    $dados['horario'] = $_POST['horario'] ?? '';
    $dados['n_visitante'] = $_POST['n_visitante'] ?? '';
    $dados['telefone'] = $_POST['telefone'] ?? '';
    $dados['email'] = $_POST['email'] ?? '';
    $dados['faixa_etaria'] = $_POST['faixa_etaria'] ?? '';

    // Validações
    if (empty($dados['nome_responsavel'])) {
        $erros['nome_responsavel'] = 'O nome do responsável é obrigatório.';
    }
    if (empty($dados['nome_escola'])) {
        $erros['nome_escola'] = 'O nome da escola é obrigatório.';
    }
    if (empty($dados['dia_pretendido'])) {
        $erros['dia_pretendido'] = 'A data é obrigatória.';
    } elseif (strtotime($dados['dia_pretendido']) < strtotime('today')) {
        $erros['dia_pretendido'] = 'A data não pode ser anterior ao dia de hoje.';
    }
    if (empty($dados['horario'])) {
        $erros['horario'] = 'O horário é obrigatório.';
    }
    if (empty($dados['n_visitante'])) {
        $erros['n_visitante'] = 'O número de visitantes é obrigatório.';
    }
    if (empty($dados['telefone'])) {
        $erros['telefone'] = 'O telefone é obrigatório.';
    }
    if (empty($dados['faixa_etaria'])) {
        $erros['faixa_etaria'] = 'A faixa etária é obrigatória.';
    }

    
    if (empty($erros)) {
        $_SESSION['sucesso'] = "Agendamento realizado com sucesso! Aguarde que entraremos em contato.";
        header('Location: /SitedoMuseu/template/agendamento.php');
        exit();
    }

    $_SESSION['erros'] = $erros;
    $_SESSION['dados'] = $dados;

    header('Location: /SitedoMuseu/template/agendamento.php');
    exit();
}
?>
