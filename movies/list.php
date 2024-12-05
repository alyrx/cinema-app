<?php 
require '../assets/db/config.db.php';

#Gravar na DB
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
    <title>Gestão de Filmes | Cinema App</title>

    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body class="open-sans-regular">
    <header>
        <h1>Gestão de Filmes</h1>
        <a class="btn-new" href="./create.php">
            <i class="bi bi-plus-lg"></i>
            <p>Novo</p>
        </a>
    </header>
    <main>
        <section id="movie-table">
                <table>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Título</th>
                        <th>Classificação</th>
                        <th>Duração</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($movies as $movie): ?>
                        <tr class="movie-info">
                            <td><?= $movie['id'] ?></td>
                            <td><?= $movie['title'] ?></td>
                            <td><?= $movie['rating'] ?></td>
                            <td><?= $movie['duration'] . "\tmin." ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>    
    </main>
    <footer></footer>
</body>
</html>