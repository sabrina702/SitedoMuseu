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
        <a class="active" href="/SitedoMuseu/template/gerenciaHorario.php"><i class="bi bi-clock"></i>  Horário de Funcionamento</a>
        <a class="active" href="/SitedoMuseu/template/gerenciaVisita.php"><i class="bi bi-calendar"></i>  Visitas</a>
      </nav>
      <a href="/SitedoMuseu/index.html" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Visão Geral das Visitas</h1>
      </header>

      <section class="secao-tabela">
        <table class="tabela-visitas">
          <thead>
            <tr>
              <th>Nome do Responsável</th>
              <th>Nome da Escola</th>
              <th>Data da Visita</th>
              <th>Hora da Visita</th>
              <th>Nº de Visitantes</th>
              <th>Faixa Etária</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Maria Silva</td>
              <td>Escola Estadual ABC</td>
              <td>20/05/2025</td>
              <td>09:00</td>
              <td>30</td>
              <td>10-12 anos</td>
              <td><a href="/SitedoMuseu/template/gerenciaVisita.php" class="btn-visualizar">Visualizar</a></td>
            </tr>
            <tr>
              <td>João Santos</td>
              <td>Colégio XYZ</td>
              <td>22/05/2025</td>
              <td>14:00</td>
              <td>25</td>
              <td>13-15 anos</td>
              <td><a href="/SitedoMuseu/template/gerenciaVisita.php" class="btn-visualizar">Visualizar</a></td>
            </tr>
          </tbody>
        </table>
      </section>
      
    </main>
  </div>
</body>
</html>