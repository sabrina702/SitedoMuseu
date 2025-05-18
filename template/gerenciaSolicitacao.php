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
        <div class="solicitacao">
        <div class="solicitacao-resumo">
          <div class="escola-info">
            <strong>Escola:</strong> Escola Municipal João Silva
          </div>
          <div class="data-hora">
            <strong>Data:</strong> 20/05/2025 |
            <strong>Hora:</strong> 14:00
          </div>
          <button class="abrir-btn">Abrir</button>
        </div>

        <div class="solicitacao-detalhes">
          <p><strong>Membro Responsável:</strong> Professora Ana Maria</p>
          <!-- Se não houver responsável, use: <p><strong>Responsável:</strong> Nenhum membro responsável</p> -->

          <label for="situacao">Situação:</label>
          <select class="situacao-select">
            <option value="Nova">Nova</option>
            <option value="Em análise">Em análise</option>
            <option value="Agendado">Agendado</option>
            <option value="Concluído">Concluído</option>
          </select>
        </div>
      </div>

        <p>Solicitações novas aparecerão aqui.</p>
      </div>
      <div class="tab-content" id="analise">
        <p>Solicitações em análise aparecerão aqui.</p>
      </div>
      <div class="tab-content" id="agendado">
        <p>Solicitações agendadas aparecerão aqui.</p>
      </div>
      <div class="tab-content" id="concluido">
        <p>Solicitações concluídas aparecerão aqui.</p>
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