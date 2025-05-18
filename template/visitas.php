<?php
  require_once "../bd/conexao.php";

  $stmt = $pdo->prepare("SELECT nome, perfil, sobre FROM membro ORDER BY nome ASC");
  $stmt->execute();
  $membros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Visitas - Museu de Ciências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGeral.css">
    <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloVisitas.css">
    <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloEquipe.css">
</head>
<body>

    <header class="custom-header">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-md-2 text-center text-md-start">
                    <img src="/SitedoMuseu/static/assets/logo.png" alt="Logo do Museu" class="logo-museu">
                </div>
                <div class="col-md-10 text-center text-md-start">
                    <h1 class="nome-museu mb-1">Museu de Ciências Naturais José Alencar de Carvalho</h1>
                    <p class="slogan-museu mb-0">IFSULDEMINAS Campus Machado</p>
                </div>
            </div>
        </div>
      
        <div class="green-space"></div>
      
        <nav class="custom-navbar">
            <div class="container d-flex justify-content-center flex-wrap gap-3">
                <a href="/SitedoMuseu/index.html" class="nav-link-custom">INÍCIO</a>
                <a href="/SitedoMuseu/template/sobre.html" class="nav-link-custom">SOBRE</a>
                <a href="/SitedoMuseu/template/visitas.php" class="nav-link-custom">VISITAS</a>
                <a href="/SitedoMuseu/template/galeria.html" class="nav-link-custom">GALERIA</a>
                <a href="/SitedoMuseu/template/agendamento.php" class="nav-link-custom">AGENDAMENTO</a>
                <a href="/SitedoMuseu/template/contato.html" class="nav-link-custom">CONTATO</a>
            </div>
        </nav>
    </header>

    <main class="container my-5 position-relative pt-5">
        <div class="section-label">
          VISITAS
          <div class="underline"></div>
        </div>
      
        <div class="content mt-4" id="conteudo">
            <section class="acervo">
                <div class="grid-acervo">
                  <div class="item-acervo">
                    <img src="/SitedoMuseu/static/imagens/temporaria.png" alt="Ambiente da Caatinga">
                    <div class="info">
                      <p class="tag">ambiente</p>
                      <h3>Caatinga</h3>
                    </div>
                  </div>
                  <div class="item-acervo">
                    <img src="/SitedoMuseu/static/imagens/temporaria.png" alt="Ambiente do Cerrado">
                    <div class="info">
                      <p class="tag">ambiente</p>
                      <h3>Cerrado</h3>
                    </div>
                  </div>
                  <div class="item-acervo">
                    <img src="/SitedoMuseu/static/imagens/temporaria.png" alt="Ambiente da Amazônia">
                    <div class="info">
                      <p class="tag">ambiente</p>
                      <h3>Mata Atântica</h3>
                    </div>
                  </div>
                  <div class="item-acervo">
                    <img src="/SitedoMuseu/static/imagens/temporaria.png" alt="Ambiente Interno do Museu">
                    <div class="info">
                      <p class="tag">ambiente</p>
                      <h3>Ecossitema Marinho</h3>
                    </div>
                  </div>
                </div>
              </section>    
        
              <div>
                <h2 class="titulo">Guia de Visitas</h2>
                <p class="texto-guia">Aqui você encontrará as informações sobre como funcionam as visitas ao museu, incluindo horários, informações sobre os ambientes e muito mais. Aproveite a nossa trilha de conhecimento!</p>
            </div>

            <div class="container mt-5">
                <h2 class="titulo">Conheça Nossa Equipe</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
                  <?php foreach ($membros as $membro): ?>
                    <div class="col">
                      <div class="card h-100 shadow-sm equipe-card">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo htmlspecialchars($membro['nome']); ?></h5>
                          <p class="card-perfil"><?php echo nl2br(htmlspecialchars($membro['perfil'])); ?></p>
                          <p class="card-text"><?php echo nl2br(htmlspecialchars($membro['sobre'])); ?></p>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
            </div> 

        </div>
    </main>
       
    <footer class="custom-footer mt-5">
        <div class="container py-4 d-flex flex-column flex-md-row justify-content-between">
            <div class="footer-left">
                <h5>Museu de Ciências Naturais</h5>
                <p>Rua do Conhecimento, 123<br>Centro – Cidade/Estado<br>Aberto de terça a domingo, 9h às 17h</p>
            </div>
        
            <div class="footer-right">
                <h5>Contato</h5>
                <p>Email: contato@museuciencias.org<br>Telefone: (00) 1234-5678</p>
                <div class="social-icons mt-2">
                <a href="#" class="me-2">Instagram</a>
                <a href="#" class="me-2">Facebook</a>
                <a href="#">YouTube</a>
                </div>
            </div>

            <div class="footer-center text-md-center mt-4 mt-md-0">
                <h5>Painel do Administrador</h5>
                <a  class="text-white" href="/SitedoMuseu/template/login.php"><i class="bi bi-lock-fill me-2"></i>Área restrita</a>
            </div>
        </div>
        <div class="container text-center border-top pt-3 mt-3">
            <h6 class="mb-0">Desenvolvido por Emily e Sabrina – Sistemas de Informação</h6>
        </div>
    </footer>
  
</body>
</html>
