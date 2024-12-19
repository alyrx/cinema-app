<?php
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAuth();
if (!isset($_GET['movie_id'])) header("Location: ../");
if (isset($_SESSION['seats'])) {
    $seats = $_SESSION['seats'];
    unset($_SESSION['seats']);
} else {
    $seats = [];
}

$movieID = $_GET['movie_id'];

// Movie sql query
$query = "SELECT * FROM movies WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$movieID]);
$movie = $stmt->fetch();

// Seats sql query
$query = "SELECT seat FROM tickets WHERE movie_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$movieID]);
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../assets/partials/head.html"; ?>
<title>Reservar Bilhetes | Cinema App</title>

<body class="open-sans-regular">
    <header>
        <h1>Cinema</h1>
        <div id="header-links">
            <?php if (isset($_SESSION['name']) & isset($_SESSION['utype'])): ?>
                <a href="../index.php" class="link">
                    <i class="bi bi-house-fill"></i>
                    <p>Home</p>
                </a>
                <?php if ($_SESSION['utype'] === "ADM"): ?>
                    <a href="../movies/index.php" class="link">
                        <i class="bi bi-film"></i>
                        <p>Filmes</p>
                    </a>
                    <a href="../users/index.php" class="link">
                        <i class="bi bi-person-fill"></i>
                        <p>Utilizadores</p>
                    </a>
                <?php endif; ?>
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
        <div class="inner-header">
            <h2>Reservar Bilhetes</h2>
        </div>
        <section id="tickets-grid">
            <div id="movie-info">
                <img src="<?= '../assets/images/movies/' . $movie['image_name'] ?>">
                <h3><?= $movie['title'] ?></h3>
                <p><?= $movie['rating'] . "\t-\t" . $movie['duration'] . "\tmin." ?></p>
            </div>
            <form action="./confirm.php" method="post" class="seat-row-form">
                <input type="hidden" name="movie_id" value="<?= $movieID ?>">
                <?php for ($i=1; $i <= 5; $i++) { ?>
                    <div class="seat-row">
                        <h3>Fila <?= $i ?></h3>
                        <?php for ($j=1; $j <= 15; $j++) { ?>
                            <div> 
                                <input type="checkbox" 
                                    name="seats[]" 
                                    value="<?= $i . '-' . $j ?>" 
                                    <?php for ($k = 0; $k < count($tickets); $k++) { 
                                        echo in_array($i . '-' . $j, $tickets[$k]) ? "checked disabled" : null;
                                    } ?>>
                            </div>
                        <?php } ?> 
                    </div>
                <?php } ?>

                <div class="form-bottom">
                    <div class="seat-legend">
                        <p><strong>Legenda</strong></p>
                        <div>
                            <input type="checkbox" checked>
                            <label>Selecionado</label>
                        </div>
                        <div>
                            <input type="checkbox" checked disabled>
                            <label>Reservado</label>
                        </div>
                        <div>
                            <input type="checkbox" >
                            <label>Disponível</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="../" class="btn-cancel">
                            <i class="bi bi-x-lg"></i>
                            <p>Cancelar</p>
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-ticket-detailed-fill"></i>
                            <p>Reservar</p>
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <?php include "../assets/partials/footer.html"; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>