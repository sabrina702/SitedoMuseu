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

    // Se não houver erros, insere os dados no banco
    if (empty($erros)) {
        try {
            // Conexão com o banco de dados
            $servidor = 'localhost';
            $usuario = 'root';
            $senha = '';
            $banco = 'bdMuseu';

            $dsn = "mysql:host=$servidor;dbname=$banco;charset=utf8";
            $conexao = new PDO($dsn, $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inserção no banco de dados
            $sql = "INSERT INTO visita (nome_responsavel, nome_escola, dia_pretendido, horario, n_visitante, telefone, email, faixa_etaria) 
                    VALUES (:nome_responsavel, :nome_escola, :dia_pretendido, :horario, :n_visitante, :telefone, :email, :faixa_etaria)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':nome_responsavel' => $dados['nome_responsavel'],
                ':nome_escola' => $dados['nome_escola'],
                ':dia_pretendido' => $dados['dia_pretendido'],
                ':horario' => $dados['horario'],
                ':n_visitante' => $dados['n_visitante'],
                ':telefone' => $dados['telefone'],
                ':email' => $dados['email'],
                ':faixa_etaria' => $dados['faixa_etaria']
            ]);

            $_SESSION['sucesso'] = "Agendamento realizado com sucesso! Aguarde que entraremos em contato.";
            header('Location: /SitedoMuseu/template/agendamento.php');
            exit();
        } catch (PDOException $e) {
            echo "Erro ao conectar ou cadastrar: " . $e->getMessage();
        }
    }

    // Caso haja erros, armazena na sessão e redireciona de volta ao formulário
    $_SESSION['erros'] = $erros;
    $_SESSION['dados'] = $dados;

    header('Location: /SitedoMuseu/template/agendamento.php');
    exit();
}
?>
