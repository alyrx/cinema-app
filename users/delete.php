<?php 
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();
verifyUser($_GET['id']);

if (!isset($_GET)) {
    header('Location: ./index.php');
}

// Delete from the database
$query = "DELETE FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

header('Location: ./index.php');
