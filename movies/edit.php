<?php 
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();

if (!isset($_GET)) {
    header('Location: ./index.php');
}

$query = "SELECT * FROM movies WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam("id", $_GET['id']);
$stmt->execute();
$movie = $stmt->fetch();

// Create temporary session variables if they are non-existent or null
if (!isset($_SESSION['movie'])) 
    $_SESSION['movie'] = [];

if (!isset($_SESSION['movie']['title'])) 
    $_SESSION['movie']['title'] = null;

if (!isset($_SESSION['movie']['rating'])) 
    $_SESSION['movie']['rating'] = null;

if (!isset($_SESSION['movie']['duration'])) 
    $_SESSION['movie']['duration'] = null;
?>
<!DOCTYPE html>
<html lang="en">

<?php include "../assets/partials/head.html"; ?>
<title>Editar Filme - Área de Gestão | Cinema App</title>

<body class="open-sans-regular">
    <header>
        <h1>Área de Gestão</h1>
        <div id="header-links">
            <?php if (isset($_SESSION['name']) & isset($_SESSION['utype'])): ?>
                <a href="../" class="link">
                    <i class="bi bi-house-fill"></i>
                    <p>Home</p>
                </a>
                <a href="./" class="active link">
                    <i class="bi bi-film"></i>
                    <p>Filmes</p>
                </a>
                <a href="../users/" class="link">
                    <i class="bi bi-person-fill"></i>
                    <p>Utilizadores</p>
                </a>
                <a id="user-dropdown-btn" class="link" onclick="openDropdown()">
                    <p><?= $_SESSION['name'] ?></p>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div id="user-dropdown-menu" onmouseleave="closeDropdown()">
                    <a href="../logout/" class="link">
                        <i class="bi bi-box-arrow-left"></i>
                        <p>Logout</p>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h2>Editar Filme</h2>
        <section id="content-section">
            <form method="post" action="./update.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                <div>
                    <label for="title">Título</label>
                    <input required type="text" name="title" id="title" value="<?= !is_null($_SESSION['movie']['title']) ? $_SESSION['movie']['title'] : $movie['title'] ?>">
                </div>
                <div>
                    <label for="rating">Classificação Etária</label>
                    <input required type="text" name="rating" id="rating" value="<?= !is_null($_SESSION['movie']['rating']) ? $_SESSION['movie']['rating'] : $movie['rating'] ?>">
                </div>
                <div>
                    <label for="duration">Duração <abbr title="Minutos">(min.)</abbr></label>
                    <input required type="number" name="duration" id="duration" min="0" value="<?= !is_null($_SESSION['movie']['duration']) ? $_SESSION['movie']['duration'] : $movie['duration'] ?>">
                </div>
                <div>
                    <label for="image">Imagem</label>
                    <input type="file" name="image" id="image">
                </div>

                <a href="./index.php" class="btn-cancel">
                    <i class="bi bi-x-lg"></i>
                    <p>Cancel</p>
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-floppy2-fill"></i>
                    <p>Atualizar</p>
                </button>
            </form>
        </section>    
    </main>
    <?php include "../assets/partials/footer.html"; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>