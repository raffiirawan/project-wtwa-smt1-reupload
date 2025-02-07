<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Online Streaming</title>
    <meta name="keywords" content="film, streaming, nonton, lk21, netflix, idlix, nonton gratis, streaming film, nonton film">
    <meta name="google-site-verification" content="ZvdngaxpRmcYN58x8TXLUhVZd4EH0WIOFVWUEQimClY" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200">
    <?php
    include "../db/conn.php";
    include "navbar2.php";
    ?>

    
<!-- Movie List -->
<div class="m-4 px-3 py-2 bg-zinc-50 rounded-lg">
    <div class="p-3">
            <h2 class="text-2xl font-semibold text-gray-800">Newest Movie</h2>
        </div>
    <div class="w-screen flex p-3 gap-2">
        <div class="text-center">
            <a href="singleMovie2.php">
                <img class="h-60" src="../uploads/posters/minions-poster.jpg">
            </a>
            <h3 class="text-lg text-black font-medium">Minions</h3>
            <p class="text-sm text-slate-500">2015</p>
        </div>
        <div class="text-center">
            <a href="singleMovie2.php">
                <img class="h-60" src="../uploads/posters/Evangelion-poster.jpg">
            </a>
            <h3 class="text-lg text-black font-medium">Evangelion</h3>
            <p class="text-sm text-slate-500">1995</p>
        </div>
        <div class="text-center">
            <img class="h-60" src="../uploads/posters/Avenger-poster.jpg">
            <h3 class="text-lg text-black font-medium">Avengers Endgame</h3>
            <p class="text-sm text-slate-500">2019</p>
        </div>
    </div>
</div>

    <!-- <div class="movie-collection">
        <?php
            $sql = "SELECT idMovie, movieImg, movieTitle, movieReleaseYear FROM moviedata";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='movie-card'>";
                    echo "<a href='singleMovie.php?idMovie=" . $row["idMovie"] . "'>";
                        echo "<img src=./uploads/posters/" .  $row["movieImg"] . ">";
                    echo "</a>";
                    echo "<h3>" . $row["movieTitle"] . "</h3>";
                    echo "<p>" . $row["movieReleaseYear"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<tr><td colspan='6'>No movies found</td></tr>";
            }
        ?>
    </div> -->
</body>
</html>