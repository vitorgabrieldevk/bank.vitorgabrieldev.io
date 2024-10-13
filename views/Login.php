<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Banco</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./public/css/Login.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 300px;">
            <h4 class="text-center mb-4">Entre rapidamente em sua conta</h4>
            <form action="<?php echo BASE_PATH; ?>/login" method="POST">
                <div class="form-group">
                    <label for="agency">Agência:</label>
                    <input type="text" id="agency" name="agency" class="form-control" required maxlength="4" placeholder="Digite a agência" />
                </div>
                <div class="form-group">
                    <label for="account">Número da Conta:</label>
                    <input type="text" id="account" name="account" class="form-control" required maxlength="6" placeholder="Digite o número da conta" />
                </div>
                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" class="form-control" required minlength="8" maxlength="8" placeholder="Digite a senha de 8 dígitos" />
                </div>
                <button type="submit" class="btn btn-success btn-block">Entrar</button>
                <div class="text-center mt-3">
                    <a href="<?php echo BASE_PATH; ?>/create-account" class="btn btn-link">Criar Conta</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
