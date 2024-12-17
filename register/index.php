<?php
session_start();

require '../assets/db/config.db.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = hash("sha256", $_POST['password']);

    register($db, $name, $email, $password);

    login($db, $email, $password);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/85791897" type="image/x-icon">
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body class="open-sans-regular">
    <main>
        <h2 class="orbitron-italic-900">Register</h2>
        <form action="./index.php" method="POST">
            <div>
                <label for="name">Nome</label>
                <input type="name" name="name" id="name" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Palavra-passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right" style="font-weight: bold;"></i>
                <p>Entrar</p>
            </button>
            <p id="register-link">Have an account? <a href="../login/">Login here</a></p>
        </form>
    </main>
</body>
</html>