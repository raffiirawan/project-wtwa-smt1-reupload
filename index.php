<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <title>Online Streaming</title>
    <meta name="keywords" content="film, streaming, nonton, lk21, netflix, idlix, nonton gratis, streaming film, nonton film">
    <meta name="google-site-verification" content="ZvdngaxpRmcYN58x8TXLUhVZd4EH0WIOFVWUEQimClY" />
</head>
<body>
    <?php
    include "./db/conn.php";
    include "navbar.php";
    ?>
    
<!-- Movie List -->
    <div class="movie-collection">
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
    </div>

    <script src="script.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>
</html>