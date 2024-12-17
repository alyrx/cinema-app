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
$query = "INSERT INTO movies (title, rating, duration, image_name) VALUES (:title, :rating, :duration, :image_name)";
$stmt = $db->prepare($query);
$stmt->bindParam(':title', $_POST['title']);
$stmt->bindParam(':rating', $_POST['rating']);
$stmt->bindParam(':duration', $_POST['duration']);

if (isset($_FILES['image'])) {
    $image = $_FILES['image'];

    // Setting the path to which the images will be saved to
    $targetDir = "../assets/images/movies/";

    // Change the filename to an unique name
    $filename = uniqid() . "_" . basename($image['name']);
    $targetFile = $targetDir . $filename;

    // Upload the new image
    $imageType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($image['tmp_name']);
    if ($check !== false) {
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            $stmt->bindParam(':image_name', $filename);
        }
    } else {
        $msg .= "<li>O ficheiro enviado não é uma imagem!</li>";
    }
} else {
    $msg .= "<li>Não foi enviada nenhuma imagem!</li>";
}

// If there are no empty fields, execute the SQL query and destroy the temporary variables.
// Otherwise, return to the previous page.
if ($msg == "") {
    $stmt->execute();
    if (isset($_SESSION['movie'])) unset($_SESSION['movie']);

    header('Location: ./index.php');
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
