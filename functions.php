<?php
session_start();

function login($db, $email, $hashedPassword)
{
  // Preparar e executar a consulta SQL
  $query = "SELECT * FROM users WHERE email = ?";
  $stmt = $db->prepare($query);
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Verify if the user exists and that the password is correct
  if ($user && $hashedPassword === $user['password']) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    header("Location: ../index.php");
    exit;
  } else {
    return "Nome de utilizador ou palavra-passe incorretos.";
  }
}


function register($db, $name, $email, $hashedPassword)
{
  $query = "INSERT INTO users(name,email,password) VALUES (:name, :email, :password)";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':password', $hashedPassword);
  $stmt->execute();
}
