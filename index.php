<?php 
session_start();
require 'assets/db/config.db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema App</title>

    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="open-sans-regular">
    <header>
        <h1>Cinema</h1>
        <div id="header-links">
            <p><?= $_SESSION['user_id'] . " " . $_SESSION['email']?></p>
        </div>
    </header>
    <main>
        <section id="movie-grid">
            <div class="movie-card">
                <img src="assets/images/sorri2.webp">

                <h3>Sorri 2</h3>
                <p>M16 - 210min</p>
            </div>
        </section>
    </main>
    <footer></footer>
</body>
</html>