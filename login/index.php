<?php
session_start();

require '../assets/db/config.db.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = hash("sha256", $_POST['password']);

    $error = login($db, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/85791897" type="image/x-icon">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <form action="./index.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Palavra-passe:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Entrar">
    </form>
    <p>Don't have an account yet? <a href="../register/">Register</a></p>
    <?php if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>
</body>

</html>