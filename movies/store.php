<?php 
session_start();
require '../assets/db/config.db.php';
include 'verify.php';
require '../functions.php';

verifyAdmin();
// Store variables temporarily
$_SESSION['movie'] = [];
$_SESSION['movie']['title'] = $_POST['title'];
$_SESSION['movie']['rating'] = $_POST['rating'];
$_SESSION['movie']['duration'] = $_POST['duration'];

// Verify if there are any empty fields
$msg = "";
$msg .= verifyTitle($_POST['title']);
$msg .= verifyRating($_POST['rating']);
$msg .= verifyDuration($_POST['duration']);

// Prepare SQL query for data
$query = "INSERT INTO movies (title, rating, duration) VALUES (:title, :rating, :duration)";
$stmt = $db->prepare($query);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':rating', $_POST['rating']);
$stmt->bindParam(':duration', $_POST['duration']);

// If there are no empty fields, execute the SQL query and destroy the temporary variables.
// Otherwise, return to the previous page.
if ($msg == "") {
    $stmt->execute();
    if (isset($_SESSION['movie'])) unset($_SESSION['movie']);

    header('Location: ./index.php');
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
