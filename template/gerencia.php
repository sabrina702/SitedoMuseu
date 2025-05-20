<?php
  session_start();
  if (!isset($_SESSION['usuario_id'])) {
      header('Location: /SitedoMuseu/template/login.php');
      exit();
  }

  require_once '../bd/conexao.php';

  $stmt = $pdo->prepare("SELECT * FROM visitante ORDER BY data_pretendida ASC");
  $stmt->execute();
  $visitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerencia.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <img src="/SitedoMuseu/static/assets/logo.png" alt="Logo do Museu" class="logo">
      <h2>Museu de Ciências Naturais José Alencar de Carvalho</h2>
      <nav>
        <a class="active" href="/SitedoMuseu/template/gerenciaMembro.php"><i class="bi bi-people-fill"></i>  Membros</a>
        <a class="active" href="/SitedoMuseu/template/gerenciaSolicitacao.php"><i class="bi bi-calendar"></i>  Solicitações</a>
      </nav>
      <a href="/SitedoMuseu/template/logout.php" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Visão Geral das Visitas</h1>
      </header>

      <section class="secao-lista">
        <?php foreach ($visitas as $index => $visita): ?>
          <div class="card-visita">
            <button class="visita-titulo" onclick="toggleDetalhes(<?= $index ?>)">
              <strong><?= htmlspecialchars($visita['nome_escola']) ?></strong> — <?= date('d/m/Y', strtotime($visita['data_pretendida'])) ?>
            </button>

            <div class="visita-detalhes" id="detalhes-<?= $index ?>">
              <p><strong>Responsável:</strong> <?= htmlspecialchars($visita['nome_responsavel']) ?></p>
              <p><strong>Telefone do Responsável:</strong> <?= htmlspecialchars($visita['telefone_responsavel']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($visita['email_responsavel']) ?></p>
              <p><strong>Telefone da Escola:</strong> <?= htmlspecialchars($visita['telefone_escola']) ?></p>
              <p><strong>Quantidade de Alunos:</strong> <?= htmlspecialchars($visita['quantidade_alunos']) ?></p>
              <p><strong>Perfil dos Alunos:</strong> <?= htmlspecialchars($visita['perfil_alunos']) ?></p>
              <p><strong>Hora Pretendida:</strong> <?= htmlspecialchars($visita['hora_pretendida']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </section>

    </main>
  </div>

  <script>
    let aberto = null;

    function toggleDetalhes(index) {
      const atual = document.getElementById(`detalhes-${index}`);

      if (aberto !== null && aberto !== atual) {
        aberto.style.display = 'none';
      }

      atual.style.display = (atual.style.display === 'block') ? 'none' : 'block';
      aberto = atual.style.display === 'block' ? atual : null;
    }
  </script>

</body>
</html>