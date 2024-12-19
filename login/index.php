<?php
session_start();

require '../assets/db/config.db.php';
require '../functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = encryptPassword($_POST['password']);

    $error = login($db, $email, $password);
}
?>
<!DOCTYPE html>
<html lang="pt">
<link rel="stylesheet" href="../assets/css/auth.css">
<?php require_once "../assets/partials/head.html"; ?>
<title>Login - Cinema App</title>

<body class="open-sans-regular">
    <main>
        <h2 class="orbitron-italic-900">Login</h2>
        <form action="./index.php" method="POST">
            <?php if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            } ?>
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
            <p id="register-link">Don't have an account yet? <a href="../register/">Register</a></p>
        </form>
    </main>
    <?php require_once "../assets/partials/footer.html"; ?>
</body>
</html>