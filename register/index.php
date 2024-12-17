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
    <title>Login</title>
</head>

<body>
    <h2>Register</h2>
    <form action="./index.php" method="POST">
        <label for="name">Nome:</label>
        <input type="name" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Palavra-passe:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Entrar">
    </form>
    <p>Have an account? <a href="../login/">Login here</a></p>

</body>

</html>