<?php
function login($db, $email, $hashedPassword) {
    // Preparar e executar a consulta SQL
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify if the user exists and that the password is correct
    if ($user && $hashedPassword === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['utype'] = $user['utype'];
        $_SESSION['name'] = $user['name'];
        header("Location: ../index.php");
        exit;
    } else {
        return "Nome de utilizador ou palavra-passe incorretos.";
    }
}

function register($db, $name, $email, $hashedPassword) {
    $query = "INSERT INTO users(name,email,password) VALUES (:name, :email, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();
}

function verifyAuth() {
    if (!isset($_SESSION['utype']) & !isset($_SESSION['name']))
        header('Location: ../login/');
}

function verifyAdmin() {
    verifyAuth();

    if ($_SESSION['utype'] != "ADM")
        header('Location: ../ ');
}

function verifyUser($id) {
    verifyAuth();

    if ($_SESSION['user_id'] != $id)
        header('Location: ../ ');
}

function verifyUserType($utype) {
    switch ($utype) {
        case 'ADM':
            return "<abbr title=\"Administrador\">ADM</abbr>";
        break;
            
        case 'USR':
            return "<abbr title=\"Utilizador\">USR</abbr>";
        break;

        default:
            return "Unknown";
        break;
    }
}

function encryptPassword($password) {
    return hash("sha256", $password);
}