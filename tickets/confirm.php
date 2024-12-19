<?php 
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['seats'])) {
        $seats = $_POST['seats'];
        $_SESSION['seats'] = $seats;
    } else {
        echo "No seats selected.";
        exit;
    }
} else {
    header("Location: ../");
    exit;
}

$movieID = $_POST['movie_id'];

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
<title>Confirmar Bilhetes | Cinema App</title>

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
            <h2>Confirmar Bilhetes</h2>
            <a class="btn" href="./?movie_id=<?= $movieID ?>">
                <i class="bi bi-arrow-left"></i>
                <p>Voltar</p>
            </a>
        </div>
        <section id="tickets-grid">
            <div id="movie-info">
                <img src="<?= '../assets/images/movies/' . $movie['image_name'] ?>">
                <h3><?= $movie['title'] ?></h3>
                <p><?= $movie['rating'] . "\t-\t" . $movie['duration'] . "\tmin." ?></p>
            </div>
            <form class="seat-row-form">
                <input type="hidden" name="movie_id" value="<?= $movieID ?>">
                <?php for ($i=1; $i <= 5; $i++) { ?>
                    <div class="seat-row">
                        <h3>Fila <?= $i ?></h3>
                        <?php for ($j=1; $j <= 15; $j++) { ?>
                            <div> 
                                <input type="checkbox" 
                                    name="seats[]" 
                                    class="confirmation-input"
                                    <?php // Check if the seat was chosen to be reserved
                                    if (in_array($i . '-' . $j, $seats)) {
                                        echo "checked";
                                    } else {
                                        for ($k = 0; $k < count($tickets); $k++){ 
                                            // Check if the seat is already taken
                                            echo in_array($i . '-' . $j, $tickets[$k]) ? "checked disabled" : null;
                                        }
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
                </div>
            </form>
            <form action="./store.php" method="post" class="confirmation-form">
                <h3>A sua reserva:</h3>
                <input type="hidden" name="movie_id" value="<?= $movieID ?>">
                <?php foreach ($seats as $seat) { ?>
                    <input type="hidden" name="seats[]" value="<?= $seat ?>">
                <?php } ?>
                <div class="seats-list">
                    <?php foreach ($seats as $seat): 
                        $seat = explode('-', $seat);?>
                        <p>Fila <?= $seat[0] ?>, Assento <?= $seat[1] ?></p>
                    <?php endforeach; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>
                        <p>Confirmar Reserva</p>
                    </button>
                </div>
            </form>
        </section>
    </main>
    <?php include "../assets/partials/footer.html"; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>