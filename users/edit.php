<?php 
session_start();
require '../assets/db/config.db.php';
require '../functions.php';

verifyAdmin();

if (!isset($_GET)) {
    header('Location: ./index.php');
}

$query = "SELECT * FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam("id", $_GET['id']);
$stmt->execute();
$user = $stmt->fetch();

// Create temporary session variables if they are non-existent or null
if (!isset($_SESSION['user'])) 
    $_SESSION['user'] = [];

if (!isset($_SESSION['user']['name'])) 
    $_SESSION['user']['name'] = null;

if (!isset($_SESSION['user']['email'])) 
    $_SESSION['user']['email'] = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/85791897" type="image/x-icon">
    <title>Editar Utilizador - Área de Gestão | Cinema App</title>

    <link rel="stylesheet" href="../assets/css/app.css">
</head>
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
                    <a href="../logout/" class="link">
                        <i class="bi bi-box-arrow-left"></i>
                        <p>Logout</p>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <h2>Editar Utilizador</h2>
        <section id="content-section">
            <form method="post" action="./update.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div>
                    <label for="name">Nome</label>
                    <input required type="text" name="name" id="name" value="<?= !is_null($_SESSION['user']['name']) ? $_SESSION['user']['name'] : $user['name'] ?>">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email" value="<?= !is_null($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $user['email'] ?>">
                </div>
                <div>
                    <label for="utype">Tipo de Utilizador</label>
                    <select name="utype" id="utype" <?= $_SESSION['user_id'] === $user['id'] ? "disabled" : null ?>>
                       <option value="USR" <?= $user['utype'] === "USR" ? "selected" : "" ?>>Utilizador</option> 
                       <option value="ADM" <?= $user['utype'] === "ADM" ? "selected" : "" ?>>Administrador</option> 
                    </select>
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
    <footer>
        <div>
            <img src="https://avatars.githubusercontent.com/u/85791897">
            <a href="https://github.com/alyrx" target="_blank">Diogo Fino</a>
        </div>
        <div>
            <img src="https://avatars.githubusercontent.com/u/91906158">
            <a href="https://github.com/ciberquaza" target="_blank">Gabriel Cardoso</a>
        </div>
    </footer>

    <script src="../assets/js/main.js"></script>
</body>
</html>