<?php
session_start();
// Define o fuso horário de Brasília
date_default_timezone_set('America/Sao_Paulo');


$erros = [];
$dados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $dados['telefone_escola'] = $_POST['telefone_escola'] ?? '';
    $dados['nome_responsavel'] = $_POST['nome_responsavel'] ?? '';
    $dados['nome_escola'] = $_POST['nome_escola'] ?? '';
    $dados['data_pretendida'] = $_POST['data_pretendida'] ?? '';
    $dados['hora_pretendida'] = $_POST['hora_pretendida'] ?? '';
    $dados['quantidade_alunos'] = $_POST['quantidade_alunos'] ?? '';
    $dados['telefone_responsavel'] = $_POST['telefone_responsavel'] ?? '';
    $dados['email_responsavel'] = $_POST['email_responsavel'] ?? '';
    $dados['perfil_alunos'] = $_POST['perfil_alunos'] ?? '';

    // Validações
    if (empty($dados['telefone_escola'])) {
        $erros['telefone_escola'] = 'O telefone é obrigatório.';
    }if (empty($dados['nome_responsavel'])) {
        $erros['nome_responsavel'] = 'O nome do responsável é obrigatório.';
    }
    if (empty($dados['nome_escola'])) {
        $erros['nome_escola'] = 'O nome da escola é obrigatório.';
    }
    if (empty($dados['data_pretendida'])) {
        $erros['data_pretendida'] = 'A data é obrigatória.';
    } elseif (strtotime($dados['data_pretendida']) < strtotime('today')) {
        $erros['data_pretendida'] = 'A data não pode ser anterior ao dia de hoje.';
    }
    if (empty($dados['hora_pretendida'])) {
        $erros['hora_pretendida'] = 'O horário é obrigatório.';
    }
    if (empty($dados['quantidade_alunos'])) {
        $erros['quantidade_alunos'] = 'O número de visitantes é obrigatório.';
    }
    if (empty($dados['telefone_responsavel'])) {
        $erros['telefone_responsavel'] = 'O telefone é obrigatório.';
    }
    if (empty($dados['perfil_alunos'])) {
        $erros['perfil_alunos'] = 'A faixa etária é obrigatória.';
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
            $sql = "INSERT INTO visitante (telefone_escola, nome_escola, nome_responsavel, telefone_responsavel, email_responsavel, quantidade_alunos, perfil_alunos, data_pretendida, hora_pretendida) 
                    VALUES (:telefone_escola, :nome_escola, :nome_responsavel, :telefone_responsavel, :email_responsavel, :quantidade_alunos, :perfil_alunos, :data_pretendida, :hora_pretendida)";
            $stmt = $conexao->prepare($sql);
            $stmt->execute([
                ':telefone_escola' => $dados['telefone_escola'],
                ':nome_escola' => $dados['nome_escola'],
                ':nome_responsavel' => $dados['nome_responsavel'],
                ':telefone_responsavel' => $dados['telefone_responsavel'],
                ':email_responsavel' => $dados['email_responsavel'],
                ':quantidade_alunos' => $dados['quantidade_alunos'],
                ':perfil_alunos' => $dados['perfil_alunos'],
                ':data_pretendida' => $dados['data_pretendida'],
                ':hora_pretendida' => $dados['hora_pretendida']
            ]);

            // Obtém o ID do visitante recém-cadastrado
            $id_visitante = $conexao->lastInsertId();

            // Data e hora atuais do sistema
            $data_acao = date('Y-m-d');
            $hora_acao = date('H:i:s');

            // Cria a solicitação com data e hora atuais
            $sqlSolicitacao = "INSERT INTO solicitacao (id_visitante, situacao, data_acao, hora_acao, id_membro) 
                            VALUES (:id_visitante, :situacao, :data_acao, :hora_acao, :id_membro)";
            $stmtSolicitacao = $conexao->prepare($sqlSolicitacao);
            $stmtSolicitacao->execute([
                ':id_visitante' => $id_visitante,
                ':situacao' => 'Nova',
                ':data_acao' => $data_acao,
                ':hora_acao' => $hora_acao,
                ':id_membro' => null  // ou algum membro padrão, ou NULL se permitido
            ]);

            $_SESSION['sucesso'] = "Solicitação realizado com sucesso! Aguarde que entraremos em contato.";
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
