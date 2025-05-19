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
    <title>Agendamento - Museu de Ciências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloGeral.css">
    <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloAgendamento.css">
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
          AGENDAMENTO
          <div class="underline"></div>
        </div>
      
        <div class="content mt-4">
            <div class="form-container">
                
                <h1>Solicite sua vista</h1>

                <?php if ($sucesso): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($sucesso) ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/SitedoMuseu/php/validacaoVisita.php">
                <div class="campo">
                    <label for="telefone_escola">Telefone de contato</label>
                    <input type="text" name="telefone_escola" id="telefone_escola" placeholder="Ex: Maria Silva"
                    value="<?= htmlspecialchars($dados['telefone_escola'] ?? '') ?>"required>
                    <?php if (isset($erros['telefone_escola'])): ?>
                        <span class="text-danger"><?= htmlspecialchars($erros['telefone_escola']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="campo">
                    <label for="nome_escola">Nome da Escola:</label>
                    <input type="text" name="nome_escola" id="nome_escola" placeholder="Ex: Escola Estadual ABC"
                    value="<?= htmlspecialchars($dados['nome_escola'] ?? '') ?>"required>
                    <?php if (isset($erros['nome_escola'])): ?>
                        <span class="text-danger"><?= htmlspecialchars($erros['nome_escola']) ?></span>
                    <?php endif; ?>
                </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="data_pretendida">Data Pretendida:</label>
                        <input type="date" name="data_pretendida" id="data_pretendida" 
                        value="<?= htmlspecialchars($dados['data_pretendida'] ?? '') ?>"required>
                        <?php if (isset($erros['data_pretendida'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['data_pretendida']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="hora_pretendida">Horário Pretendido:</label>
                        <input type="time" name="hora_pretendida" id="hora_pretendida" 
                        value="<?= htmlspecialchars($dados['hora_pretendida'] ?? '') ?>"required>
                        <?php if (isset($erros['hora_pretendida'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['hora_pretendida']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="quantidade_alunos">Número de Visitantes:</label>
                        <input type="number" name="quantidade_alunos" id="quantidade_alunos" placeholder="Ex: 30"
                        value="<?= htmlspecialchars($dados['quantidade_alunos'] ?? '') ?>"required>
                        <?php if (isset($erros['quantidade_alunos'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['quantidade_alunos']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="perfil_alunos">Faixa Etária ou Escolaridade dos Visitantes:</label>
                        <input type="text" name="perfil_alunos" id="perfil_alunos" placeholder="Ex: 10 a 12 anos"
                        value="<?= htmlspecialchars($dados['perfil_alunos'] ?? '') ?>"required>
                        <?php if (isset($erros['perfil_alunos'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['perfil_alunos']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                    <div class="campo">
                        <label for="nome_responsavel">Nome do Resposável:</label>
                        <input type="text" name="nome_responsavel" id="nome_responsavel" placeholder="Ex: Bruna Maria"
                        value="<?= htmlspecialchars($dados['nome_responsavel'] ?? '') ?>"required>
                        <?php if (isset($erros['nome_responsavel'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['nome_responsavel']) ?></span>
                        <?php endif; ?>
                    </div>

                <div class="grid-dupla">
                    <div class="campo">
                        <label for="telefone_responsavel">Telefone do Resposável:</label>
                        <input type="text" name="telefone_responsavel" id="telefone_responsavel" placeholder="Ex: (35) 99999-9999"
                        value="<?= htmlspecialchars($dados['telefone_responsavel'] ?? '') ?>"required>
                        <?php if (isset($erros['telefone_responsavel'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['telefone_responsavel']) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <label for="email_responsavel">Email do Resposável:</label>
                        <input type="email" name="email_responsavel" id="email_responsavel" placeholder="Ex: exemplo@escola.com"
                        value="<?= htmlspecialchars($dados['email_responsavel'] ?? '') ?>"required>
                        <?php if (isset($erros['email_responsavel'])): ?>
                            <span class="text-danger"><?= htmlspecialchars($erros['email_responsavel']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                

                <button type="submit">Solicitar Visita</button>
                </form>
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
