<?php 
session_start();
require '../../assets/db/config.db.php';
require '../../functions.php';

$query = "SELECT t.*, m.title FROM tickets AS t
        INNER JOIN movies AS m ON t.movie_id = m.id 
        WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/85791897" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/app.css">
    
    <title>Bilhetes | Cinema App</title>
</head>

<body class="open-sans-regular">
    <header>
        <h1>Cinema</h1>
        <div id="header-links">
            <?php if (isset($_SESSION['name']) & isset($_SESSION['utype'])): ?>
                <a href="../../" class="link">
                    <i class="bi bi-house-fill"></i>
                    <p>Home</p>
                </a>
                <?php if ($_SESSION['utype'] === "ADM"): ?>
                    <a href="../../movies/" class="link">
                        <i class="bi bi-film"></i>
                        <p>Filmes</p>
                    </a>
                    <a href="../../users/" class="link">
                        <i class="bi bi-person-fill"></i>
                        <p>Utilizadores</p>
                    </a>
                <?php endif; ?>
                <a id="user-dropdown-btn" class="link" onclick="openDropdown()">
                    <p><?= $_SESSION['name'] ?></p>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div id="user-dropdown-menu" onmouseleave="closeDropdown()">
                    <a href="./" class="link">
                        <i class="bi bi-ticket-detailed-fill"></i>
                        <p>Bilhetes</p>
                    </a>
                    <hr>
                    <a href="../../logout/" class="link">
                        <i class="bi bi-box-arrow-left"></i>
                        <p>Logout</p>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <div class="inner-header">
            <h2>Lista de Bilhetes de <?= $_SESSION['name']?></h2>
        </div>
        <section id="content-section">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Título do Filme</th>
                        <th>Lugar (Fila - Assento)</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr class="movie-info">
                            <td><?= $ticket['id'] ?></td>
                            <td><?= $ticket['title'] ?></td>
                            <td><?= $ticket['seat'] ?></td>
                            <td>
                                <div class="operations-list">
                                    <form action="./delete.php" method="get">
                                        <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                        <button type="submit" class="btn-delete" title="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                            <p>Cancelar Reserva</p>
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
    <?php include "../../assets/partials/footer.html"; ?>

    <script src="../../assets/js/main.js"></script>
</body>
</html>