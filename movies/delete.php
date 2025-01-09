<?php 
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();

if (!isset($_GET)) {
    header('Location: ./index.php');
}

$query = "SELECT image_name FROM movies WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$currentImage = $stmt->fetchColumn();

// Setting the path where the images are saved
$oldImagePath = "../assets/images/movies/" . $currentImage;
if (file_exists($oldImagePath)) {
    unlink($oldImagePath); // Delete the movie image
}

// Delete from the database
$query = "DELETE FROM movies WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

header('Location: ./index.php');
