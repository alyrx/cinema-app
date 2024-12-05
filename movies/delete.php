<?php 
require '../assets/db/config.db.php';

if (!isset($_GET)) {
    header('Location: ' . is_null($_SERVER['HTTP_REFERER']) ? './index.php' : $_SERVER['HTTP_REFERER']);
}

// Delete from the database
$query = "DELETE FROM movies WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

header('Location: ./index.php');
