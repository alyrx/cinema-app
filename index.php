<?php
session_start();
require 'assets/db/config.db.php';
require 'functions.php';

$query = "SELECT * FROM movies WHERE visible = true";
$stmt = $db->prepare($query);
$stmt->execute();
$movies = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/85791897" type="image/x-icon">

    <title>Cinema App</title>

    <link rel="stylesheet" href="./assets/css/app.css">
</head>

<body class="open-sans-regular">
    <header>
        <h1>Cinema</h1>
        <div id="header-links">
            <?php if (isset($_SESSION['name']) & isset($_SESSION['utype'])): ?>
                <a href="./index.php" class="active link">
                    <i class="bi bi-house-fill"></i>
                    <p>Home</p>
                </a>
                <?php if ($_SESSION['utype'] === "ADM"): ?>
                    <a href="./movies/index.php" class="link">
                        <i class="bi bi-film"></i>
                        <p>Filmes</p>
                    </a>
                    <a href="./users/index.php" class="link">
                        <i class="bi bi-person-fill"></i>
                        <p>Utilizadores</p>
                    </a>
                <?php endif; ?>
                <a id="user-dropdown-btn" class="link" onclick="openDropdown()">
                    <p><?= $_SESSION['name'] ?></p>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div id="user-dropdown-menu" onmouseleave="closeDropdown()">
                    <a href="./tickets/list/" class="link">
                        <i class="bi bi-ticket-detailed-fill"></i>
                        <p>Bilhetes</p>
                    </a>
                    <hr>
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
        <div class="banner-container">
            <img src="assets/images/MainPageBanner.png" alt="Banner" class="banner">
        </div>
        <section id="movie-grid">
            <?php if ($movies) {
                foreach ($movies as $movie) { ?>
                    <a href="./tickets/?movie_id=<?= $movie['id'] ?>" class="movie-card">
                        <img src="<?= 'assets/images/movies/' . $movie['image_name'] ?>">
                        <h3><?= $movie['title'] ?></h3>
                        <p><?= $movie['rating'] . "\t-\t" . $movie['duration'] . "\tmin." ?></p>
                    </a>
                <?php }
            } else { ?>
                <?php if (isset($_SESSION['utype']) && $_SESSION['utype'] === "ADM") { ?>
                    <div class="admin-messages">
                        <div class="admin-head">
                            <i class="bi bi-info-circle-fill"></i>
                            <p>Apenas você consegue ver esta mensagem</p>
                        </div>
                        <p class="admin-no-movie">Não existem filmes com a visibilidade ativa. <br>Experimente adicionar filmes à base de dados ou torná-los visíveis!</p>
                    </div>
                <?php } else { ?>
                    <h3>Sem filmes disponíveis!</h3>
                <?php } ?>
            <?php } ?>
        </section>
    </main>
    <?php include "./assets/partials/footer.html"; ?>

    <script src="assets/js/main.js"></script>
</body>

</html>