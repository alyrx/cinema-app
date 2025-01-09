<?php 
session_start();
require '../functions.php';

verifyAdmin();
if (!isset($_GET)) {
    header('Location: ./index.php');
}

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

<?php include "../assets/partials/head.html"; ?>
<title>Novo Utilizador - Área de Gestão | Cinema App</title>

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
        <h2>Criar Novo Utilizador</h2>
        <section id="content-section">
            <form method="post" action="./store.php">
                <div>
                    <label for="name">Nome</label>
                    <input required type="text" name="name" id="name">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email">
                </div>
                <div>
                    <label for="password">Palavra-passe</label>
                    <input required type="password" name="password" id="password">
                </div>
                <div>
                    <label for="utype">Tipo de Utilizador</label>
                    <select name="utype" id="utype">
                        <option value="USR">Utilizador</option>
                        <option value="ADM">Administrador</option>
                    </select>
                </div>

                <a href="./" class="btn-cancel">
                    <i class="bi bi-x-lg"></i>
                    <p>Cancelar</p>
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-floppy2-fill"></i>
                    <p>Guardar</p>
                </button>
            </form>
        </section>    
    </main>
    <?php include "../assets/partials/footer.html"; ?>
    
    <script src="../assets/js/main.js"></script>
</body>
</html>