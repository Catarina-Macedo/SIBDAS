<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>

    <!-- Custom CSS -->
    <link href="./assets/css/estilos.css" rel="stylesheet">

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="imgGym flex items-center justify-center h-screen">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <img src="assets/images/Logo.png" alt="" class="w-24 rounded-xl">
            <form id="passwordForm">
                <div class="form-control mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email"
                        class="input input-bordered" required>
                </div>
                <div class="form-control mb-4">
                    <label class="label" for="password">
                        <span class="label-text">Senha</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha"
                        class="input input-bordered" required>
                </div>
                <div class="form-control mb-4">
                    <label class="label" for="confirmPassword">
                        <span class="label-text">Senha novamente</span>
                    </label>
                    <input type="password" id="confirmPassword" name="confirmPassword"
                        placeholder="Digite sua senha novamente" class="input input-bordered" required>
                    <span id="error-message" class="label-text-alt text-error hidden">As senhas não coincidem</span>
                </div>
                <div class="form-control mb-4">
                    <label class="label cursor-pointer">
                        <span class="label-text">Lembrar-me</span>
                        <input type="checkbox" class="checkbox checkbox-primary" />
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-success" onclick="location.href='login.html'">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');
            const errorMessage = document.getElementById('error-message');
            const form = document.getElementById('passwordForm');

            form.addEventListener('submit', function (e) {
                if (password.value !== confirmPassword.value) {
                    e.preventDefault();
                    errorMessage.classList.remove('hidden');
                } else {
                    errorMessage.classList.add('hidden');
                }
            });

            password.addEventListener('input', function () {
                if (password.value === confirmPassword.value) {
                    errorMessage.classList.add('hidden');
                }
            });

            confirmPassword.addEventListener('input', function () {
                if (password.value === confirmPassword.value) {
                    errorMessage.classList.add('hidden');
                }
            });
        });

    </script>
</body>

</html>