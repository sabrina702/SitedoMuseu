<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../bd/conexao.php';

$sucesso = $_SESSION['sucesso'] ?? null;
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];

unset($_SESSION['sucesso'], $_SESSION['erros'], $_SESSION['dados']);

// VERIFICA SE O ID FOI PASSADO NA URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

// SE NÃO TIVER DADOS NA SESSÃO, BUSCA DO BANCO
if (empty($dados)) {
    $stmt = $pdo->prepare("SELECT * FROM membro WHERE id = ?");
    $stmt->execute([$id]);
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        die("Membro não encontrado.");
    }

    $dados['senha'] = ''; // nunca mostramos a senha real
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaMembro.css"/>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloEditaMembro.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container">
    <aside class="sidebar">
      <img src="/SitedoMuseu/static/assets/logo.png" alt="Logo do Museu" class="logo">
      <h2>Museu de Ciências Naturais José Alencar de Carvalho</h2>       
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Editar membro</h1>
        <a href="/SitedoMuseu/template/gerenciaMembro.php" class="btn-add"> <i class="bi bi-arrow-left"></i> Voltar </a>
      </header>

       <form method="POST" action="/SitedoMuseu/php/valida_editar_membro.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <?php if (!empty($sucesso)): ?>
          <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
        <?php endif; ?>

        <?php if (!empty($erros['geral'])): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($erros['geral']) ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($dados['nome'] ?? '') ?>">
          <?php if (isset($erros['nome'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['nome']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($dados['email'] ?? '') ?>">
          <?php if (isset($erros['email'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['email']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="senha">Nova Senha (opcional):</label>
            <input type="password" id="senha" name="senha" value="<?= htmlspecialchars($dados['senha'] ?? '') ?>" style="padding: 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;
            background-color: #f9f9f9; transition: border-color 0.3s; width: 100%;">
            <?php if (isset($erros['senha'])): ?>
                <span class="error-message"><?= htmlspecialchars($erros['senha']) ?></span>
            <?php endif; ?>
        </div>


        <div class="form-group">
          <label for="sobre">Sobre:</label>
          <textarea id="sobre" name="sobre"><?= htmlspecialchars($dados['sobre'] ?? '') ?></textarea>
          <?php if (isset($erros['sobre'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['sobre']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="perfil">Perfil:</label>
          <select id="perfil" name="perfil">
            <option value="">-- Selecione --</option>
            <option value="Monitor(a)" <?= ($dados['perfil'] == 'Monitor(a)') ? 'selected' : '' ?>>Monitor(a)</option>
            <option value="Professor(a)" <?= ($dados['perfil'] == 'Professor(a)') ? 'selected' : '' ?>>Professor(a)</option>
            <option value="Coordenador(a) do Museu" <?= ($dados['perfil'] == 'Coordenador(a) do Museu') ? 'selected' : '' ?>>Coordenador(a) do Museu</option>
          </select>
          <?php if (isset($erros['perfil'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-add-membro">Salvar Alterações</button>
      </form> 
        
    </main>
  </div>
</body>
</html>
