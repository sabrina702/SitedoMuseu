<?php
session_start();
$sucesso = $_SESSION['sucesso'] ?? null;
$erros = $_SESSION['erros'] ?? [];
$dados = $_SESSION['dados'] ?? [];
unset($_SESSION['sucesso']);
unset($_SESSION['erros']);
unset($_SESSION['dados']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaMembro.css"/>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloAddMembro.css"/>
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
        <div class="header">
        <h1>Cadastrar membro</h1>
        <a href="/SitedoMuseu/template/gerenciaMembro.php" class="btn-add">← Voltar</a>
        </div>

        <form method="POST" action="/SitedoMuseu/php/valida_add_membro.php">
        <?php if ($sucesso): ?>
            <div class="alert alert-success">
            <?= htmlspecialchars($sucesso) ?>
            </div>
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
            <label for="senha">Senha:</label>
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
            <option value="Monitor(a)" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Monitor(a)') ? 'selected' : '' ?>>Monitor(a)</option>
            <option value="Professor(a)" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Professor(a)') ? 'selected' : '' ?>>Professor(a)</option>
            <option value="Coordenador(a) do Museu" <?= (isset($dados['perfil']) && $dados['perfil'] == 'Coordenador(a) do Museu') ? 'selected' : '' ?>>Coordenador(a) do Museu</option>
            </select>
            <?php if (isset($erros['perfil'])): ?>
            <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-add-membro">Cadastrar</button>
        </form>
    </main>
  </div>
</body>
</html>
