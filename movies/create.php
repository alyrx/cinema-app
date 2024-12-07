<?php 
session_start();

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Filme - Área de Gestão | Cinema App</title>

    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body class="open-sans-regular">
    <header>
        <h1>Área de Gestão</h1>
        <div>
            <a href="./index.php">Filmes</a>
        </div>
    </header>
    <main>
        <h2>Criar Novo Filme</h2>
        <section id="content-section">
            <form method="post" action="./store.php">
                <div>
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" value="<?= $_SESSION['movie']['title'] !== "" ? $_SESSION['movie']['title'] : "" ?>">
                </div>
                <div>
                    <label for="rating">Classificação Etária</label>
                    <input type="text" name="rating" id="rating" value="<?= $_SESSION['movie']['rating'] !== "" ? $_SESSION['movie']['rating'] : "" ?>">
                </div>
                <div>
                    <label for="duration">Duração <abbr title="Minutos">(min.)</abbr></label>
                    <input type="number" name="duration" id="duration" min="0" value="<?= $_SESSION['movie']['duration'] !== "" ? $_SESSION['movie']['duration'] : "" ?>">
                </div>

                <a href="./index.php" class="btn-cancel">
                    <i class="bi bi-x-lg"></i>
                    <p>Cancel</p>
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-floppy2-fill"></i>
                    <p>Guardar</p>
                </button>
            </form>
        </section>    
    </main>
    <footer></footer>
</body>
</html>