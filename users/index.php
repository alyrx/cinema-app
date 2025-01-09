<?php 
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();

$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "../assets/partials/head.html"; ?>
<title>Utilizadores - Área de Gestão | Cinema App</title>

<body class="open-sans-regular">
    <header>
        <h1>Área de Gestão</h1>
        <div id="header-links">
            <?php if (isset($_SESSION['name']) & isset($_SESSION['utype'])): ?>
                <a href="../" class="link">
                    <i class="bi bi-house-fill"></i>
                    <p>Home</p>
                </a>
                <a href="../movies/" class="link">
                    <i class="bi bi-film"></i>
                    <p>Filmes</p>
                </a>
                <a href="./" class="active link">
                    <i class="bi bi-person-fill"></i>
                    <p>Utilizadores</p>
                </a>
                <a id="user-dropdown-btn" class="link" onclick="openDropdown()">
                    <p><?= $_SESSION['name'] ?></p>
                    <i class="bi bi-caret-down-fill"></i>
                </a>
                <div id="user-dropdown-menu" onmouseleave="closeDropdown()">
                    <a href="../tickets/list/" class="link">
                        <i class="bi bi-ticket-detailed-fill"></i>
                        <p>Bilhetes</p>
                    </a>
                    <hr>
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
            <h2>Lista de Utilizadores</h2>
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
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Tipo de Utilizador</th>
                        <th>Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="movie-info">
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= verifyUserType($user['utype']) ?></td>
                            <td>
                                <div class="operations-list">
                                    <form action="./edit.php" method="get">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="btn-edit" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                    <form action="./delete.php" method="get">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button type="submit" class="btn-delete" title="Eliminar" <?= $_SESSION['user_id'] === $user['id'] ? "disabled" : null ?>>
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