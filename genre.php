<?php
include('db/conn.php'); // Koneksi ke database

// Ambil genre dari parameter URL
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Query untuk mengambil film berdasarkan genre
if ($genre) {
    // Jika genre dipilih, filter film berdasarkan genre
    $query = "SELECT * FROM moviedata WHERE genre = ? ORDER BY movieTitle";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Jika tidak ada genre yang dipilih, tampilkan semua film
    $query = "SELECT * FROM moviedata ORDER BY movieTitle";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre - NEDLIX</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<?php
include "navbar.php";
?>

        <h2>Movies by Genre</h2>
    <main>
          <!-- Menampilkan genre di dalam dropdown atau list -->
        <div class="genre-list">
            <ul>
                <?php
                // Ambil daftar genre dari database untuk filter
                $genre_query = "SELECT DISTINCT movieGenre FROM moviedata ORDER BY movieGenre";
                $genre_result = $conn->query($genre_query);
                while ($genre_item = $genre_result->fetch_assoc()):
                ?>
                    <li>
                        <a href="/project/genre.php?genre=<?= urlencode($genre_item['genre']) ?>">
                            <?= htmlspecialchars($genre_item['movieGenre']) ?>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <div class="movie-list">
            <!-- Menampilkan film berdasarkan genre yang dipilih -->
            <?php if ($result->num_rows > 0): ?>
                <?php while ($movie = $result->fetch_assoc()): ?>
                    <div class="movie-item">
                        <img src="<?= htmlspecialchars($movie['movieImg']) ?>" alt="<?= htmlspecialchars($movie['movieTitle']) ?>" class="movie-poster">
                        <h3><?= htmlspecialchars($movie['movieTitle']) ?></h3>
                        <p><?= htmlspecialchars($movie['movieDesc']) ?></p>
                        <a href="/project/singleMovie.php?id=<?= $movie['idMovieData'] ?>">View Details</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No movies found for this genre.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>