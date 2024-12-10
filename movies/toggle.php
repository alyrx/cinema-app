<?php
session_start();
require '../assets/db/config.db.php';

// Prepare SQL query for data
$query = "UPDATE movies 
        SET visible = !visible
        WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

header('Location: ./index.php');
