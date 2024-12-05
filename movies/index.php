<?php 
// Start session to destroy unsecessary temporary variables
session_start();
session_destroy();

require '../assets/db/config.db.php';

$query = "SELECT * FROM movies";
$stmt = $db->prepare($query);
$stmt->execute();
$movies = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes - Área de Gestão | Cinema App</title>

    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body class="open-sans-regular">
    <header>
        <h1>Área de Gestão</h1>
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
                                    <form action="./edit.php" method="get">
                                        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                        <button href="./store.php" type="submit" class="btn-edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                    <form action="./delete.php" method="get">
                                        <input type="hidden" name="id" value="<?= $movie['id'] ?>">
                                        <button href="./store.php" type="submit" class="btn-delete">
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
</body>
</html>