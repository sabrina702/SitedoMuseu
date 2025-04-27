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
      <header class="header">
        <h1>Cadastrar membro</h1>
        <a href="/SitedoMuseu/template/gerenciaMembro.php" class="btn-add"> <i class="bi bi-arrow-left"></i> Voltar </a>
      </header>

        <form method="POST" action="/SitedoMuseu/php/valida_add_membro.php">
                <?php if ($sucesso): ?>
                    <div class="alert alert-success" role="alert">
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
                    <label for="sobre">Sobre:</label>
                    <textarea id="sobre" name="sobre"><?= htmlspecialchars($dados['sobre'] ?? '') ?></textarea>
                    <?php if (isset($erros['sobre'])): ?>
                        <span class="error-message"><?= htmlspecialchars($erros['sobre']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="perfil">Perfil:</label>
                    <select id="perfil" name="perfil">
                        <option value="monitor" <?= (isset($dados['perfil']) && $dados['perfil'] == 'monitor') ? 'selected' : '' ?>>Monitor(a)</option>
                        <option value="professor" <?= (isset($dados['perfil']) && $dados['perfil'] == 'professor') ? 'selected' : '' ?>>Professor(a)</option>
                    </select>
                    <?php if (isset($erros['perfil'])): ?>
                        <span class="error-message"><?= htmlspecialchars($erros['perfil']) ?></span>
                    <?php endif; ?>
                </div>

                <button  class="btn-add-membro" type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
  </div>
</body>
</html>
