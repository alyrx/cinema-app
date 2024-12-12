<?php
require 'assets/db/config.db.php';
require 'functions.php';

// echo '<pre>';
// echo print_r($_SESSION);
// echo '</pre>';
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
            <?php if (isset($_SESSION['name']) && isset($_SESSION['user_id'])): ?>
                <a id="user-dropdown-btn" class="link" onclick="openDropdown()">
                    <p><?= $_SESSION['name'] ?></p>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div id="user-dropdown-menu" onmouseleave="closeDropdown()">
                    <a href="./logout/" class="link">
                        <i class="bi bi-box-arrow-left"></i>
                        <p>Logout</p>
                    </a>
                </div>
            <?php else: ?>
                <div id="auth-btn">
                    <a href="./login/" class="btn">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <p>Login</p>
                    </a>
                    <a href="./register/" class="btn">
                        <i class="bi bi-person-fill-add"></i>
                        <p>Register</p>
                    </a>
                </div>
            <?php endif; ?>
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

    <script src="assets/js/main.js"></script>
</body>

</html>