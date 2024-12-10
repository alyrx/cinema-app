<?php
session_start();
require '../assets/db/config.db.php'; // Arquivo de conexão com a base de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = hash("sha256", $_POST['password']);

    // Preparar e executar a consulta SQL
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($query); 
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    echo $password;
    echo "\n" . $user['password'];
    // Verificar se o utilizador existe e a palavra-passe é correta
    if ($user && $password === $user['password']) {
        // Login bem-sucedido, guardar informações na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header("Location: ../index.php"); // Redirecionar para o dashboard (página protegida)
        exit;
    } else {
        $error = "Nome de utilizador ou palavra-passe incorretos.";
    }
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
    <h2>Login</h2>
    <form action="./index.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        
        <label for="password">Palavra-passe:</label>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="Entrar">
    </form>

    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
