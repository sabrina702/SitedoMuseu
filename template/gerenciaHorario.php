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
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaHorario.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <img src="/SitedoMuseu/static/assets/logo.png" alt="Logo do Museu" class="logo">
      <h2>Museu de Ciências Naturais José Alencar de Carvalho</h2>
      <nav>
        <a class="active" href="/SitedoMuseu/template/gerencia.php"><i class="bi bi-people-fill"></i>Visão geral</a> 
      </nav>
      <a href="/SitedoMuseu/index.html" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Gerenciamento do Horário de Funcionamento</h1>
      </header>
      <section class="form-section">
    <form action="/SitedoMuseu/php/validaHorario.php" method="POST" class="form-horario">
      <?php if ($sucesso): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($sucesso) ?>
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label for="diaSemana">Dia da Semana</label>
        <input type="text" id="diaSemana" name="diaSemana" placeholder="Ex: Segunda-feira" 
              value="<?= htmlspecialchars($dados['diaSemana'] ?? '') ?>">
        <?php if (isset($erros['diaSemana'])): ?>
          <span class="errors"><?= htmlspecialchars($erros['diaSemana']) ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="horaAbertura">Hora de Abertura</label>
        <input type="time" id="horaAbertura" name="horaAbertura" 
              value="<?= htmlspecialchars($dados['horaAbertura'] ?? '') ?>">
        <?php if (isset($erros['horaAbertura'])): ?>
          <span class="errors"><?= htmlspecialchars($erros['horaAbertura']) ?></span>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="horaFechamento">Hora de Fechamento</label>
        <input type="time" id="horaFechamento" name="horaFechamento" 
              value="<?= htmlspecialchars($dados['horaFechamento'] ?? '') ?>">
        <?php if (isset($erros['horaFechamento'])): ?>
          <span class="errors"><?= htmlspecialchars($erros['horaFechamento']) ?></span>
        <?php endif; ?>
      </div>


      <button type="submit" class="btn-salvar">Salvar Alterações</button>
    </form>
  </section>

    </main>

  </div>
</body>
</html>