<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Museu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/SitedoMuseu/static/css/estiloLogin.css">
</head>
<body>
    <div class="page-container">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="left-box"></div>
                <div class="right-box">
                    <h2>LOGIN</h2>
                    <p class="text-muted">Entre para continuar</p>

                    <?php
                    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                        echo '<div class="alert alert-danger">E-mail ou senha inválidos!</div>';
                    }
                    ?>

                    <form method="POST" action="/SitedoMuseu/php/validaLogin.php" onsubmit="return validarFormulario()">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com">
                            <div id="emailErro" class="error-message"></div>
                        </div>

                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="********">
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
