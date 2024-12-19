<?php 
session_start();
require '../assets/db/config.db.php';
include 'verify.php';
require '../functions.php';

verifyAdmin();

// Store variables temporarily
$_SESSION['user'] = [];
$_SESSION['user']['name'] = $_POST['name'];
$_SESSION['user']['email'] = $_POST['email'];
$_SESSION['user']['utype'] = $_POST['utype'];

// Verify if there are any empty fields
$msg = "";
$msg .= verifyName($_POST['name']);
$msg .= verifyEmail($_POST['email']);
$msg .= verifyPassword($_POST['password']);

// Prepare SQL query for data
$query = "INSERT INTO users (name,email,utype,password) VALUES (:name, :email, :utype, :password)";
$stmt = $db->prepare($query);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':utype', $_POST['utype']);
$stmt->bindParam(':password', encryptPassword($_POST['password']));

// If there are no empty fields, execute the SQL query and destroy the temporary variables.
// Otherwise, return to the previous page.
if ($msg == "") {
    $stmt->execute();
    if (isset($_SESSION['user'])) unset($_SESSION['user']);

    header('Location: ./index.php');
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
