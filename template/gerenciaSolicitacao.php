<?php
require_once '../bd/conexao.php'; // Aqui deve definir $pdo, conexão PDO

function buscarSolicitacoesPorSituacao($pdo, $situacao) {
    $sql = "SELECT s.id, s.data_acao AS data_visita, s.hora_acao AS hora_visita, s.situacao,
                   v.nome_escola AS escola, v.nome_responsavel AS responsavel,
                   m.nome AS nome_membro
            FROM solicitacao s
            JOIN visitante v ON s.id_visitante = v.id
            LEFT JOIN membro m ON s.id_membro = m.id
            WHERE s.situacao = ?
            ORDER BY s.id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$situacao]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$situacoes = ['Nova', 'Em análise', 'Agendado', 'Concluído'];
$solicitacoesPorSituacao = [];

foreach ($situacoes as $situacao) {
    $solicitacoesPorSituacao[$situacao] = buscarSolicitacoesPorSituacao($pdo, $situacao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaSolicitacao.css"/>
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
      <a class="active" href="/SitedoMuseu/template/gerencia.php"><i class="bi bi-people-fill"></i>Visão geral</a> 
      </nav>
      <a href="/SitedoMuseu/index.html" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Gerenciamento das Solicitações</h1>
      </header>

      <section class="solicitacoes">

      <!-- Abas -->
      <div class="tabs">
        <button class="tab-button active" data-tab="nova">Nova</button>
        <button class="tab-button" data-tab="analise">Em análise</button>
        <button class="tab-button" data-tab="agendado">Agendado</button>
        <button class="tab-button" data-tab="concluido">Concluído</button>
      </div>

      <!-- Conteúdo das abas -->
      <div class="tab-content active" id="nova">
  <?php foreach ($solicitacoesPorSituacao['Nova'] as $solicitacao): ?>
    <div class="solicitacao">
      <div class="solicitacao-resumo">
        <div class="escola-info">
          <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
        </div>
        <div class="data-hora">
          <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
          <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
        </div>
        <button class="abrir-btn">Abrir</button>
      </div>

      <div class="solicitacao-detalhes" style="display:none;">
        <p>
          <strong>Membro Respon:</strong>
          <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
        </p>

        <form class="form-situacao" action="editarVisita.php" method="POST">
          <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
          <label for="situacao">Situação:</label>
          <select name="situacao" class="situacao-select">
            <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
            <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
            <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
            <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
          </select>
          <button class="button-salvar" type="submit">Salvar</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
</div>

      <div class="tab-content" id="analise">
        <?php foreach ($solicitacoesPorSituacao['Em análise'] as $solicitacao): ?>
    <div class="solicitacao">
      <div class="solicitacao-resumo">
        <div class="escola-info">
          <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
        </div>
        <div class="data-hora">
          <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
          <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
        </div>
        <button class="abrir-btn">Abrir</button>
      </div>

      <div class="solicitacao-detalhes" style="display:none;">
        <p>
          <strong>Membro Respon:</strong>
          <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
        </p>

        <form class="form-situacao" action="editarVisita.php" method="POST">
          <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
          <label for="situacao">Situação:</label>
          <select name="situacao" class="situacao-select">
            <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
            <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
            <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
            <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
          </select>
          <button class="button-salvar" type="submit">Salvar</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
      </div>
      <div class="tab-content" id="agendado">
         <?php foreach ($solicitacoesPorSituacao['Agendado'] as $solicitacao): ?>
    <div class="solicitacao">
      <div class="solicitacao-resumo">
        <div class="escola-info">
          <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
        </div>
        <div class="data-hora">
          <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
          <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
        </div>
        <button class="abrir-btn">Abrir</button>
      </div>

      <div class="solicitacao-detalhes" style="display:none;">
        <p>
          <strong>Membro Respon:</strong>
          <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
        </p>

        <form class="form-situacao" action="editarVisita.php" method="POST">
          <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
          <label for="situacao">Situação:</label>
          <select name="situacao" class="situacao-select">
            <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
            <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
            <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
            <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
          </select>
          <button class="button-salvar" type="submit">Salvar</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
      </div>
      <div class="tab-content" id="concluido">
         <?php foreach ($solicitacoesPorSituacao['Concluído'] as $solicitacao): ?>
    <div class="solicitacao">
      <div class="solicitacao-resumo">
        <div class="escola-info">
          <strong>Escola:</strong> <?= htmlspecialchars($solicitacao['escola']) ?>
        </div>
        <div class="data-hora">
          <strong>Data:</strong> <?= date('d/m/Y', strtotime($solicitacao['data_visita'])) ?> |
          <strong>Hora:</strong> <?= htmlspecialchars($solicitacao['hora_visita']) ?>
        </div>
        <button class="abrir-btn">Abrir</button>
      </div>

      <div class="solicitacao-detalhes" style="display:none;">
        <p>
          <strong>Membro Respon:</strong>
          <?= htmlspecialchars($solicitacao['nome_membro'] ?: 'Nenhum membro responsável') ?>
        </p>

        <form class="form-situacao" action="editarVisita.php" method="POST">
          <input type="hidden" name="id" value="<?= $solicitacao['id'] ?>">
          <label for="situacao">Situação:</label>
          <select name="situacao" class="situacao-select">
            <option value="Nova" <?= $solicitacao['situacao'] == 'Nova' ? 'selected' : '' ?>>Nova</option>
            <option value="Em análise" <?= $solicitacao['situacao'] == 'Em análise' ? 'selected' : '' ?>>Em análise</option>
            <option value="Agendado" <?= $solicitacao['situacao'] == 'Agendado' ? 'selected' : '' ?>>Agendado</option>
            <option value="Concluído" <?= $solicitacao['situacao'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
          </select>
          <button class="button-salvar" type="submit">Salvar</button>
        </form>
      </div>
    </div>
  <?php endforeach; ?>
      </div>
    </section>

    </main>

  </div>

<script>
  const tabButtons = document.querySelectorAll(".tab-button");
  const tabContents = document.querySelectorAll(".tab-content");

  tabButtons.forEach(button => {
    button.addEventListener("click", () => {
      // Remove classes "active"
      tabButtons.forEach(btn => btn.classList.remove("active"));
      tabContents.forEach(content => content.classList.remove("active"));

      // Ativa aba clicada
      button.classList.add("active");
      document.getElementById(button.dataset.tab).classList.add("active");
    });
  });
</script>

<script>
  document.querySelectorAll('.form-situacao').forEach(form => {
  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(form);
    const idSolicitacao = formData.get('id');
    const novaSituacao = formData.get('situacao');

    fetch(form.action, {
      method: 'POST',
      body: formData
    }).then(response => response.text())
      .then(data => {
        if(data.trim() === 'OK'){
          alert('Situação atualizada com sucesso!');
    location.reload();
        } else {
          alert('Erro ao atualizar situação.');
        }
      })
      .catch(err => alert('Erro na comunicação com o servidor.'));
  });
});
</script>
  

<script>
  document.querySelectorAll(".abrir-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const detalhes = btn.closest(".solicitacao").querySelector(".solicitacao-detalhes");
      detalhes.style.display = detalhes.style.display === "block" ? "none" : "block";
      btn.textContent = btn.textContent === "Abrir" ? "Fechar" : "Abrir";
    });
  });
</script>


</body>
</html>