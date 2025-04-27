<?php
session_start();
$erros = $_SESSION['erros'] ?? [];  
$erroLogin = $_SESSION['erroLogin'] ?? '';  
$dados = $_SESSION['dados'] ?? [];  
unset($_SESSION['erros'], $_SESSION['erroLogin'], $_SESSION['dados']);  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Museu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloLogin.css">
</head>
<body>
    <div class="page-container">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="left-box"></div>
                <div class="right-box">
                    <a href="/SitedoMuseu/index.html" class="text-decoration-none text-dark mb-3 d-inline-block">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a> 

                    <h2>LOGIN</h2>
                    <p class="text-muted">Entre para continuar</p>

                    <?php if (!empty($erroLogin)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($erroLogin) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/SitedoMuseu/php/validaLogin.php" onsubmit="validarFormulario(event)">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com"
                                   value="<?= htmlspecialchars($dados['email'] ?? '') ?>">
                            <?php if (isset($erros['email'])): ?>
                                <span class="text-danger"><?= htmlspecialchars($erros['email']) ?></span>
                            <?php endif; ?>
                            <div id="emailErro" class="error-message"></div>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="********">
                            <?php if (isset($erros['senha'])): ?>
                                <div class="error-message text-danger"><?= htmlspecialchars($erros['senha']) ?></div>
                            <?php endif; ?>
                            <div id="senhaErro" class="error-message"></div>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-success" type="submit">Entrar</button>
                        </div>
                        <p class="text-center mt-3"><a href="#" class="text-black">Esqueci minha senha</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validarFormulario() {
            var email = document.getElementById("email").value.trim();
            var senha = document.getElementById("senha").value.trim();
            var emailErro = document.getElementById("emailErro");
            var senhaErro = document.getElementById("senhaErro");
            var valid = true;

            emailErro.textContent = "";
            senhaErro.textContent = "";

            if (!email) {
                emailErro.textContent = "Digite um e-mail válido.";
                valid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                emailErro.textContent = "Formato de e-mail inválido.";
                valid = false;
            }

            if (!senha) {
                senhaErro.textContent = "Digite uma senha.";
                valid = false;
            } else if (!/[A-Za-z]/.test(senha) || !/[0-9]/.test(senha) || !/[^A-Za-z0-9]/.test(senha)) {
                senhaErro.textContent = "A senha deve ter letras, números e símbolos.";
                valid = false;
            }

            return valid;
        }
    </script>

</body>
</html>
