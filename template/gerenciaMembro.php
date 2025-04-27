<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaMembro.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <img src="/SitedoMuseu/static/assets/logo.png" alt="Logo do Museu" class="logo">
      <h2>Museu de Ciências Naturais José Alencar de Carvalho</h2>
      <nav>
        <a class="active" href="/SitedoMuseu/template/gerencia.php"  ><i class="bi bi-people-fill"></i>Visão geral</a> 
      </nav>
      <a href="/SitedoMuseu/index.html" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
        <header class="header">
            <h1>Gerenciamento da Equipe</h1>
            <a href="/SitedoMuseu/template/addMembro.php"  style="text-decoration: none" class="btn-add"> + Novo Membro </a>
        </header>
    
        <section class="table-section">
        <table class="team-table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Sobre</th>
              <th>Perfil</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Maria Silva</td>
              <td>maria@email.com</td>
              <td>Graduanda em Biologia, bolsista PIBIC.</td>
              <td>Monitor(a)</td>
              <td>
                <a href="/SitedoMuseu/template/editaMembro.php" class="btn-edit"><i class="bi bi-pencil-square"></i> Editar</a>
                <a href="/SitedoMuseu/template/editaMembro.php" class="btn-delete"><i class="bi bi-trash"></i> Excluir</a>
              </td>
            </tr>
            <tr>
              <td>João Souza</td>
              <td>joao@email.com</td>
              <td>Voluntário no setor de Paleontologia.</td>
              <td>Professor(a)</td>
              <td>
              <a href="/SitedoMuseu/template/editaMembro.php" class="btn-edit"><i class="bi bi-pencil-square"></i> Editar</a>
              <a href="/SitedoMuseu/template/editaMembro.php" class="btn-delete"><i class="bi bi-trash"></i> Excluir</a>
              </td>
            </tr>
            <!-- Mais linhas aqui -->
          </tbody>
        </table>
      </section>
      <!-- TABELA TERMINA AQUI -->

    </main>
   
    
</body>
</html>