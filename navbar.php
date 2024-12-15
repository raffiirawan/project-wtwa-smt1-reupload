<?php
include('db/conn.php'); // Koneksi ke database

// Ambil daftar genre dari database
$genre_query = "SELECT idMovieGenre, movieGenre FROM moviegenre ORDER BY movieGenre";
$genre_result = $conn->query($genre_query);
?>


<header>
    <nav class="navbar">
        <a href="/project/index.php">
            <h1>NEDLIX</h1>
        </a>
        <div class="nav-list">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                <!-- Jika sudah login -->
                <a href="/project/index.php">All Movies</a>
                <!-- <a href="/project/genre.php">Genre</a> -->
                <a href="/project/admin/dashboard.php">Dashboard</a>
                <a href="/project/admin/register.php">Add User</a>
                <a href="/project/admin/logout.php">Logout</a>
            <?php else: ?>
                <!-- Jika belum login -->
                <a href="/project/index.php">All Movies</a>
                <!-- <a href="/project/genre.php">Genre</a> -->
                <a href="/project/admin/login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>