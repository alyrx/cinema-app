<?php

# Connection credentials
$username = "root";
$password = "";

try {
    # Create the connection
    $db = new PDO("mysql:host=localhost;dbname=cinema_app", $username, $password);
    # Connect
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Couldn't connect to the database: " . $e->getMessage();
}