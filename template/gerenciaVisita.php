<?php
  session_start();
  if (!isset($_SESSION['usuario_id'])) {
      header('Location: /SitedoMuseu/template/login.php');
      exit();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Painel de Monitoras</title>
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGerenciaVisita.css"/>
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
      <a href="/SitedoMuseu/template/logout.php" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>     
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Gerenciamento das Visitas</h1>
      </header>

      <section >
        
      </section>
    </main>

  </div>
</body>
</html>