<?php 
// Start session to then verify if the user is authenticated & is admin,
// and to destroy temporary "movie" variable, if it exists.
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();
if (isset($_SESSION['movie'])) unset($_SESSION['movie']);

$query = "SELECT * FROM movies";
$stmt = $db->prepare($query);
$stmt->execute();
$movies = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../assets/partials/head.html"; ?>
<title>Filmes - Área de Gestão | Cinema App</title>

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
        <div class="inner-header">
            <h2>Lista de Filmes</h2>
            <a class="btn" href="./create.php">
                <i class="bi bi-plus-lg"></i>
                <p>Novo</p>
            </a>
        </div>
        <section id="content-section">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Classificação Etária</th>
                        <th>Duração</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movies as $movie): ?>
                        <tr class="movie-info">
                            <td><?= $movie['id'] ?></td>
                            <td><?= $movie['title'] ?></td>
                            <td><?= $movie['rating'] ?></td>
                            <td><?= $movie['duration'] . "\tmin." ?></td>
                            <td>
                                <div class="operations-list">
                                    <form action="./toggle.php" method="get">
                                        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                        <button type="submit" class="btn-visible" title="Alternar visibilidade">
                                            <?php if ($movie['visible'] == true): ?>
                                                <i class="bi bi-eye-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-eye-slash-fill"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                    <form action="./edit.php" method="get">
                                        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                        <button type="submit" class="btn-edit" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                    <form action="./delete.php" method="get">
                                        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                        <button type="submit" class="btn-delete" title="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>    
    </main>
    <?php include "../assets/partials/footer.html"; ?>

    <script src="../assets/js/main.js"></script>
</body>
</html>