<?php
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAuth();

$movieID = $_POST['movie_id'];
$userID = $_SESSION['user_id'];
$seats = $_POST['seats'];

// Verify if the seats are already taken
$query = "SELECT seat FROM tickets WHERE movie_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$movieID]);
$tickets = $stmt->fetchAll();

foreach ($tickets as $ticket) {
    if (in_array($ticket['seat'], $seats)) {
        header("Location: ../tickets/index.php?movie_id=$movieID&error=seat_taken");
        exit;
    }
}


foreach ($seats as $seat) {
    echo print_r($seat) . "<br>";
    $query = "INSERT INTO tickets (user_id, movie_id, seat) VALUES (:user_id, :movie_id, :seat)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userID);
    $stmt->bindParam(':movie_id', $movieID);
    $stmt->bindParam(':seat', $seat);
    $stmt->execute();
    
}

if (isset($_SESSION['seats'])) unset($_SESSION['seats']);

header("Location: ../tickets/index.php?movie_id=$movieID&success=tickets_reserved");
?>
<!DOCTYPE html>