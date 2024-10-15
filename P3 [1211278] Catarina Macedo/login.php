<?php

session_start();

// check if there are errors (after login_submit)
$validation_errors = [];
if (!empty($_SESSION['validation_errors'])) {
    $validation_errors = $_SESSION['validation_errors'];
    unset($_SESSION['validation_errors']);
}
// check if there is a server erro
$server_error = [];
if (!empty($_SESSION['server_error'])) {
    $server_error = $_SESSION['server_error'];
    unset($_SESSION['server_error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Custom CSS -->
    <link href="./assets/css/estilos.css" rel="stylesheet">

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="imgGym flex items-center justify-center h-screen">
    <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
            <a href="ReGen.html"> <img src="assets/images/Logo_green.png" alt="" class="w-24 rounded-xl"></a>


            <form action="Homepage.php" method="POST">
                <div class="form-control mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" class="input input-bordered" required>
                </div>
                <div class="form-control mb-6">
                    <label class="label" for="password">
                        <span class="label-text">Senha</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" class="input input-bordered" required>
                </div>
                <div class="form-control mb-4">
                    <label class="label cursor-pointer">
                        <span class="label-text">Lembrar-me</span>
                        <input type="checkbox" class="checkbox checkbox-primary" name="remember_me" />
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-success">Entrar</button>
                </div>

                <div>
                    <!-- Erros -->
                    <?php if (!empty($validation_errors)) : ?>
                        <div class="alert alert-danger p-2 m-2 text-center">
                            <?php foreach ($validation_errors as $error) : ?>
                                <div><?= $error ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($server_error)) : ?>
                        <div class="alert alert-danger p-2 m-2 text-center">
                            <div><?= $server_error ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>