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
        <a class="active" href="#"><i class="bi bi-people-fill"></i> Gerenciar Monitores</a>
        <a href="#" onclick="openModal()"><i class="bi bi-person-plus-fill"></i> Adicionar</a>
        <a href="#" onclick="openEditModal()"><i class="bi bi-pencil-square"></i> Editar</a>
      </nav>
      <a href="/SitedoMuseu/index.html" class="logout">
        <i class="bi bi-box-arrow-right"></i> Sair
      </a>   
    </aside>

    <main class="main-content">
      <header class="header">
        <h1>Painel de controle</h1>
        <button class="btn-add" onclick="openModal()">+ Nova Monitora</button>
      </header>

      <section class="grid">
        <div class="card">
          <img src="/SitedoMuseu/static/imagens/monitora1.jpg" alt="Foto da Monitora">
          <div class="info">
            <h3>Julia</h3>
            <p>Email: julia@universidade.edu</p>
            <p>Curso: BIO | Período: 5º</p>
          </div>
          <div class="actions">
            <button class="edit" onclick="openEditModal()">Editar</button>
            <button class="delete" onclick="openDeleteModal(this)">Excluir</button>
          </div>
        </div>

        <div class="card">
          <img src="/SitedoMuseu/static/imagens/monitora2.jpg" alt="Foto da Monitora">
          <div class="info">
            <h3>Gabriely</h3>
            <p>Email: gabriely@universidade.edu</p>
            <p>Curso: BIO | Período: 5º</p>
          </div>
          <div class="actions">
            <button class="edit">Editar</button>
            <button class="delete" onclick="openDeleteModal(this)">Excluir</button>
          </div>
        </div>

        <div class="card">
          <img src="/SitedoMuseu/static/imagens/monitora3.jpg" alt="Foto da Monitora">
          <div class="info">
            <h3>Giovana</h3>
            <p>Email: giovana@universidade.edu</p>
            <p>Curso: BIO | Período: 5º</p>
          </div>
          <div class="actions">
            <button class="edit">Editar</button>
            <button class="delete" onclick="openDeleteModal(this)">Excluir</button>
          </div>
        </div>
      </section>
    </main>
  </div>

  <div class="modal" id="modalForm">
    <div class="modal-content">
      <h2>Adicionar Monitor</h2>
      <form>
        <input type="text" placeholder="Nome" required />
        <input type="email" placeholder="Email Institucional" required />
        <input type="text" placeholder="Curso" />
        <input type="text" placeholder="Período" />
        <input type="file" />
        <textarea placeholder="Sobre ela..." rows="4"></textarea>
        <div class="modal-buttons">
          <button type="button" onclick="closeModal()">Cancelar</button>
          <button type="submit">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal" id="modalEdit">
    <div class="modal-content">
      <h2>Editar Monitor</h2>
      <form>
        <label for="edit-nome">Nome</label>
        <input type="text" id="edit-nome" placeholder="Nome" value="Julia" />
  
        <label for="edit-email">Email Institucional</label>
        <input type="email" id="edit-email" placeholder="Email Institucional" value="julia@universidade.edu" />
  
        <label for="edit-curso">Curso</label>
        <input type="text" id="edit-curso" placeholder="Curso" value="BIO" />
  
        <label for="edit-periodo">Período</label>
        <input type="text" id="edit-periodo" placeholder="Período" value="5º" />
  
        <label for="edit-sobre">Sobre</label>
        <textarea id="edit-sobre" placeholder="Sobre ela..." rows="4">Monitora ativa desde o 3º período.</textarea>
  
        <div class="modal-buttons">
          <button type="button" onclick="closeEditModal()">Cancelar</button>
          <button type="submit">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function openModal() {
      document.getElementById('modalForm').style.display = 'flex';
    }
    function closeModal() {
      document.getElementById('modalForm').style.display = 'none';
    }

    let deleteTarget = null;

    function openDeleteModal(button) {
      deleteTarget = button.closest('.card');
      document.getElementById('modalConfirmDelete').style.display = 'flex';
    }

    function closeDeleteModal() {
      deleteTarget = null;
      document.getElementById('modalConfirmDelete').style.display = 'none';
    }

    function confirmDelete() {
      if (deleteTarget) {
        deleteTarget.remove(); 
      }
      closeDeleteModal();
    }

    function openEditModal() {
      document.getElementById('modalEdit').style.display = 'flex';
    }
    function closeEditModal() {
      document.getElementById('modalEdit').style.display = 'none';
    }

  </script>

  <div class="modal" id="modalConfirmDelete">
    <div class="modal-content">
      <h2>Tem certeza que deseja excluir?</h2>
      <div class="modal-buttons">
        <button type="button" onclick="closeDeleteModal()">Cancelar</button>
        <button type="button" onclick="confirmDelete()">Confirmar</button>
      </div>
    </div>
  </div>

</body>
</html>